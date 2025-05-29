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
        $request->validate([
            'date' => 'required|date',
            'heure' => 'required',
            'lieu' => 'required|string',
            'language' => 'required|in:ar,fr'
        ]);

        $doctorant = Doctorant::findOrFail($request->doctorant_id);
        $language = $request->input('language', 'ar');

        // Load the appropriate template based on language
        $templateFile = $language === 'ar' ? 'anonse_ar.docx' : 'anonse_fr.docx';
        $template = new TemplateProcessor(public_path("templates/$templateFile"));

        if ($language === 'ar') {
            $this->setArabicValues($doctorant, $template, $request);
        } else {
            $this->setFrenchValues($doctorant, $template, $request);
        }

        // Prepare jury members
        $this->processJuryMembers($doctorant, $template, $language, $request);

        // Save and export the file
        $fileName = ($language === 'ar' ? 'اعلان_مناقشة_' : 'Annonce_Soutenance_') . $doctorant->NOM . '.docx';
        $savePath = public_path("annonces/$fileName");
        $template->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend();
    }

    private function setArabicValues($doctorant, $template, $request)
    {
        // General information
        $template->setValue('CIVILITE', $doctorant->SEXE === 'Féminin' ? 'السيدة' : 'السيد');
        $template->setValue('NOM_DOCTORANT', $doctorant->NOMAR . ' ' . $doctorant->PRENOMAR);
        $template->setValue('PRONOUN', $doctorant->SEXE === 'Féminin' ? 'ستناقش' : 'سيناقش');
        $template->setValue('FORMATION', $doctorant->FORMATION);
        $template->setValue('SUJET', $doctorant->SUJET);
        $template->setValue('ENCADRANT', $doctorant->ENCADRANT);

        // Format Arabic date and time
        $date = Carbon::parse($request->date);
        $dateAr = $this->formatArabicDate($date);
        $heureAr = $this->formatArabicTime($request->heure);
        $template->setValue('DATE_DISCUSSION', trim($dateAr ?? 'غير معروف'));
        $template->setValue('HEURE_DISCUSSION', trim($heureAr ?? 'غير معروف'));
        $template->setValue('LIEU_DISCUSSION', trim($request->lieu ?? 'غير معروف'));
    }

    private function setFrenchValues($doctorant, $template, $request)
    {
        // General information
        $template->setValue('CIVILITE', $doctorant->SEXE === 'Féminin' ? 'Madame' : 'Monsieur');
        $template->setValue('NOM_DOCTORANT', $doctorant->NOM . ' ' . $doctorant->PRENOM);
        $template->setValue('PRONOUN', 'présentera');
        $template->setValue('FORMATION', $doctorant->FORMATION);
        $template->setValue('SUJET', $doctorant->SUJET);
        $template->setValue('ENCADRANT', $doctorant->ENCADRANT);

        // Format French date and time
        $date = Carbon::parse($request->date);
        $dateFr = $this->formatFrenchDate($date);
        $heureFr = $this->formatFrenchTime($request->heure);
        $template->setValue('DATE_DISCUSSION', trim($dateFr ?? 'non spécifié'));
        $template->setValue('HEURE_DISCUSSION', trim($heureFr ?? 'non spécifié'));
        $template->setValue('LIEU_DISCUSSION', trim($request->lieu ?? 'non spécifié'));
    }

    private function processJuryMembers($doctorant, $template, $language, $request)
    {
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

            if ($language === 'ar') {
                $template->setValue("JURY$i", $prof?->nom_prenom_arabe ?? $juryName);
                $template->setValue("DOC$i", $prof ? ($prof->doc ?? ($prof->sexe === 'Féminin' ? 'د.ة' : 'د.')) : 'د.');
                $template->setValue("GRADE$i", trim(($prof["GRADE$i"] ?? $prof?->status_ar ?? 'غير معروف') . ' - ' . ($prof?->etablissement_ar ?? 'غير معروف')));
            } elseif ($language === 'fr') {
                $template->setValue("JURY$i", $prof?->nom_prenom ?? $juryName);
                $template->setValue("DOC$i", $prof ? ($prof->doc ?? ($prof->sexe === 'Féminin' ? 'Mme.' : 'M.')) : 'M.');
                $template->setValue("GRADE$i", trim(($prof["GRADE$i"] ?? $prof?->status_ar ?? 'non spécifié') . ' - ' . ($prof?->etablissement_ar ?? 'non spécifié')));
            }

            $template->setValue("STATUS$i", trim($doctorant["STATUS$i"] ?? ($language === 'ar' ? 'غير معروف' : 'non spécifié')));
        }
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

    private function formatFrenchDate(Carbon $date)
    {
        $days = [
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
        ];

        $months = [
            '01' => 'janvier', '02' => 'février', '03' => 'mars', '04' => 'avril',
            '05' => 'mai', '06' => 'juin', '07' => 'juillet', '08' => 'août',
            '09' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre',
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

        if ($hour === 12 && $minute === 1) {
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

        $displayHour = $hour % 12 ?: 12;
        $arabicHour = $arabicNumbers[$displayHour];

        $minuteText = match (true) {
            $minute === 0 => '',
            $minute === 15 => 'والربع',
            $minute === 30 => 'والنصف',
            $minute === 45 => 'إلا ربع',
            $minute < 10 => "و{$minute} دقائق",
            default => "و{$minute} دقيقة"
        };

        return "الساعة {$arabicHour} {$minuteText} {$period}";
    }

    private function formatFrenchTime($time)
    {
        if (!str_contains($time, ':')) {
            return 'heure non spécifiée';
        }

        [$hour, $minute] = explode(':', $time);
        $hour = intval($hour);
        $minute = intval($minute);

        if ($hour === 0 && $minute === 0) {
            return 'minuit';
        }
        if ($hour === 12 && $minute === 0) {
            return 'midi';
        }

        return sprintf('%02d:%02d', $hour, $minute);
    }
}
