<?php

namespace App\Http\Controllers;

use App\Models\Doctorant;
use App\Models\Prof;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class DoctorantWordExportController extends Controller
{
    public function showForm($id)
    {
        $doctorant = Doctorant::findOrFail($id);
        return view('doctorants.annonce_form', compact('doctorant'));
    }

    public function generate(Request $request)
    {

        $doctorant = Doctorant::findOrFail($request->doctorant_id);
        $template = new TemplateProcessor(public_path('anonse2025.docx'));

        // معلومات عامة
        $template->setValue('CIVILITE', $doctorant->SEXE === 'Féminin' ? 'السيدة' : 'السيد');
        $template->setValue('NOM_DOCTORANT', $doctorant->NOMAR . ' ' . $doctorant->PRENOMAR);

        $template->setValue('PRONOUN', $doctorant->SEXE === 'Féminin' ? 'ستناقش' : 'سيناقش');
        $template->setValue('FORMATION', $doctorant->FORMATION);
        $template->setValue('SUJET', $doctorant->SUJET);
        $template->setValue('ENCADRANT', $doctorant->ENCADRANT);

        // تعريب التاريخ والوقت
        $date = Carbon::parse($request->date);
        App::setLocale('ar');
        $dateAr = $this->formatArabicDate($date);
        $heureAr = $this->formatArabicTime($request->heure);
        $template->setValue('DATE_DISCUSSION', trim($dateAr??'غير معروف'));
        $template->setValue('HEURE_DISCUSSION', trim($heureAr??'غير معروف'));
        $template->setValue('LIEU_DISCUSSION', trim($request->lieu??'غير معروف'));

        // اللغة المختارة
        $language = $request->input('language');

        // إعداد أعضاء اللجنة
        for ($i = 1; $i <= 7; $i++) {
            $juryName = trim($doctorant["JURY$i"] ?? '');
            if (!$juryName) {
                $template->setValue("JURY$i", '');
                $template->setValue("DOC$i", '');
                $template->setValue("GRADE$i", '');
                $template->setValue("STATUS$i", '');
                continue;
            }

            $juryNameNormalized = strtolower($juryName);

            $prof = Prof::whereRaw('LOWER(nom_prenom_arabe) = ?', [$juryNameNormalized])
                        ->orWhereRaw('LOWER(nom_prenom) = ?', [$juryNameNormalized])
                        ->first();

            if (!$prof) {
                $prof = Prof::whereRaw('LOWER(nom_prenom_arabe) LIKE ?', ['%' . $juryNameNormalized . '%'])
                            ->orWhereRaw('LOWER(nom_prenom) LIKE ?', ['%' . $juryNameNormalized . '%'])
                            ->first();
            }

            $template->setValue("JURY$i", $prof?->nom_prenom_arabe ?? $juryName);

            $template->setValue("DOC$i", $prof ? ($prof->doc ?? ($prof->sexe === 'Féminin' ? 'د.ة' : 'د.')) : 'د.');
            $template->setValue("GRADE$i", trim(($prof["GRADE$i"] ?? $prof?->status_ar ?? 'غير معروف'). ' - ' . ($prof?->etablissement_ar ?? 'غير معروف')));
            $template->setValue("STATUS$i", trim(($doctorant["STATUS$i"] ?? 'غير معروف')));
        }

        // حفظ وتصدير الملف
        $fileName = 'اعلان_مناقشة_' . $doctorant->NOMAR . '.docx';
        $savePath = public_path("annonces/$fileName");
        $template->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend();
    }

    private function formatArabicDate(Carbon $date)
    {
        $days = [
            'Saturday' => 'السبت',
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
        ];

        $months = [
            '01' => 'يناير', '02' => 'فبراير', '03' => 'مارس', '04' => 'أبريل',
            '05' => 'ماي', '06' => 'يونيو', '07' => 'يوليوز', '08' => 'غشت',
            '09' => 'شتنبر', '10' => 'أكتوبر', '11' => 'نونبر', '12' => 'دجنبر',
        ];

        $dayName = $days[$date->format('l')] ?? $date->format('l');
        $day = $date->format('d');
        $month = $months[$date->format('m')];
        $year = $date->format('Y');

        return "$dayName $day $month $year";
    }

    private function formatArabicTime($time)
    {
        if (!str_contains($time, ':')) {
            return 'توقيت غير معروف';
        }

        [$hour, $minute] = explode(':', $time);
        $hour = intval($hour);
        $minute = intval($minute);

        // حالات خاصة
        if ($hour === 0 && $minute === 0) {
            return 'منتصف الليل تماماً';
        }

        $arabicNumbers = [
            1 => 'الواحدة',
            2 => 'الثانية',
            3 => 'الثالثة',
            4 => 'الرابعة',
            5 => 'الخامسة',
            6 => 'السادسة',
            7 => 'السابعة',
            8 => 'الثامنة',
            9 => 'التاسعة',
            10 => 'العاشرة',
            11 => 'الحادية عشرة',
            12 => 'الثانية عشرة',
        ];

        // تحديد الفترة
        if ($hour === 12 && $minute === 0) {
            return 'الساعة الثانية عشرة ظهراً';
        } elseif ($hour === 12) {
            $period = 'ظهراً';
        } elseif ($hour >= 1 && $hour < 12) {
            $period = 'صباحاً';
        } elseif ($hour >= 13 && $hour < 17) {
            $period = 'بعد الزوال';
        } else {
            $period = 'مساءً';
        }

        // تحويل الساعة لصيغة 12
        $displayHour = $hour % 12 ?: 12;
        $arabicHour = $arabicNumbers[$displayHour];

        $minuteText = match (true) {
            $minute === 0 => 'تماماً',
            $minute === 15 => 'والربع',
            $minute === 30 => 'والنصف',
            $minute === 45 => 'إلا ربع',
            $minute < 10 => "و{$minute} دقائق",
            default => "و{$minute} دقيقة"
        };

        return "الساعة {$arabicHour} {$minuteText} {$period}";
    }


}
