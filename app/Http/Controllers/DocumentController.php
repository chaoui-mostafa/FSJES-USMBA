<?php
namespace App\Http\Controllers;

use App\Models\Doctorant;
use App\Models\Prof;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DoctorantWordExportController extends Controller
{
    public function export(Request $request, $id)
    {
        $doctorant = Doctorant::findOrFail($id);

        // Path to the template and output file
        $templatePath = storage_path('app/templates/chawi.docx');
        $outputPath = storage_path("app/exports/annonce_{$doctorant->id}.docx");

        // Create the directory if it doesn't exist
        if (!file_exists(dirname($outputPath))) {
            mkdir(dirname($outputPath), 0755, true);
        }

        // Load the template using TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Gender based on "SEXE" field
        $isFemale = strtolower($doctorant->SEXE) === 'féminin';
        $gender = $isFemale ? 'السيدة' : 'السيد';

        // Pronoun (to indicate if the person is defending or will defend)
        $pronoun = $isFemale ? 'ستناقش' : 'سيناقش';

        // Format the defense date and time
        $datetime = Carbon::parse($doctorant->DATESOUTENANCE)->locale('ar');
        $dateAr = $datetime->translatedFormat('l d F Y');
        $timeAr = $this->convertTimeToArabic($datetime->format('H:i'));

        // Get the Jury members using the foreign key relation with Prof model


        $juryMembers = [];
        for ($i = 1; $i <= 8; $i++) {
            $juryRelation = "jury{$i}";
            $statusField = "STATUS{$i}";

            $professor = $doctorant->$juryRelation;

            if ($professor) {
                $juryMembers[$i] = [
                    'name' => $professor->nom_prenom_arabe,
                    'grade' => $professor->grade_ar,
                    'statusAr' => $professor->status_ar,
                    'etablissementAr' => $professor->etablissement_ar,
                    'status' => $doctorant->$statusField,
                ];
            }
        }


        // Set values in the template
        $templateProcessor->setValue('CIVILITE', $gender);

        $templateProcessor->setValue('NOM_DOCTORANT', $doctorant->NOMAR . ' ' . $doctorant->PRENOMAR);
        $templateProcessor->setValue('PRONOUN', $pronoun);
        $templateProcessor->setValue('DATE_DISCUSSION', $dateAr);
        $templateProcessor->setValue('HEURE_DISCUSSION', $timeAr);
        $templateProcessor->setValue('LIEU_DISCUSSION', $request->input('lieu'));
        $templateProcessor->setValue('THESE', $doctorant->THESE);
        $templateProcessor->setValue('SUJET', $doctorant->SUJET);
        $templateProcessor->setValue('ENCADRANT', $doctorant->ENCADRANT);
        $templateProcessor->setValue('COENCADRANT', $doctorant->COENCADRANT);
        $templateProcessor->setValue('FORMATION', $doctorant->FORMATION);


        // Set the jury members and their grades and statuses
        foreach ($juryMembers as $index => $jury) {
            $templateProcessor->setValue("DOC", "د.");
            $templateProcessor->setValue("JURY{$index}", $jury['name']);
            $templateProcessor->setValue("GRADE{$index}", $jury['grade']);
            $templateProcessor->setValue("STATUS{$index}", $jury['status']);
            $templateProcessor->setValue("ETABLISSEMENT{$index}", $jury['etablissementAr']);
            $templateProcessor->setValue("STATUSAR{$index}", $jury['statusAr']);

        }

        // Save the document
        $templateProcessor->saveAs($outputPath);

        // Return the generated document as a downloadable file
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    // Function to convert time to Arabic format
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
        $template = new TemplateProcessor(public_path('template_annonce.docx'));

        // معلومات عامة
        $template->setValue('CIVILITE', $doctorant->SEXE === 'Féminin' ? 'السيدة' : 'السيد');
        $template->setValue('NOM_DOCTORANT', $doctorant->NOMAR . ' ' . $doctorant->PRENOMAR);
        $template->setValue('PRONOUN', $doctorant->SEXE === 'Féminin' ? 'ستناقش' : 'سيناقش');
        $template->setValue('FORMATION', $doctorant->FORMATION);

        // تعريب التاريخ والوقت
        $date = Carbon::parse($request->date);
        App::setLocale('ar');
        $dateAr = $this->formatArabicDate($date);
        $heureAr = $this->formatArabicTime($request->heure);

        $template->setValue('DATE_DISCUSSION', $dateAr);
        $template->setValue('HEURE_DISCUSSION', $heureAr);
        $template->setValue('LIEU_DISCUSSION', $request->lieu);

        // اللغة المختارة
        $language = $request->input('language');

        // إعداد أعضاء اللجنة
        for ($i = 1; $i <= 7; $i++) {

            $juryName = $doctorant["JURY$i"] ?? '';
            if (!$juryName) {
                $template->setValue("JURY$i", '');
                $template->setValue("DOC$i", '');
                $template->setValue("GRADE$i", '');
                $template->setValue("STATUS$i", '');
                continue;
            }

            $prof = null;
            if ($language === 'ar') {
                $prof = Prof::where('nom_prenom_arabe', $juryName)->first();
            } else {
                $prof = Prof::where('nom_prenom', $juryName)->first();
            }

            // محاولة ثانية إذا لم يتم العثور على الأستاذ
            if (!$prof) {
                $prof = Prof::where('nom_prenom_arabe', 'LIKE', "%$juryName%")
                ->orWhere('nom_prenom', 'LIKE', "%$juryName%")
                ->first();
            }

            $template->setValue("JURY$i", $prof?->nom_prenom_arabe);
            $template->setValue("DOC$i", $prof?->doc?? ($prof->sexe==='Féminin' ? 'د.ة' : 'د.'));
            $template->setValue("GRADE$i", $prof["GRADE$i"] ?? $prof?->status_ar ?? '');
            $template->setValue("STATUS$i", trim(($doctorant["STATUS$i"] ?? '') . ' - ' . ($prof?->etablissement_ar ?? '')));

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
        [$hour, $minute] = explode(':', $time);
        $hour = intval($hour);
        $minute = intval($minute);

        $arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩','١٠','١١','١٢'];
        $arabicHour = $arabicNumbers[($hour % 12) ?: 12];

        $minuteText = match(true) {
            $minute === 0 => 'تماما',
            $minute === 15 => 'والربع',
            $minute === 30 => 'والنصف',
            $minute === 45 => 'إلا ربع',
            default => "و{$minute} دقيقة"
        };

        return "الساعة {$arabicHour} {$minuteText}";
    }
}
