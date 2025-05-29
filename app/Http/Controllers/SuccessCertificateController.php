<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctorant;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Prof;

class SuccessCertificateController extends Controller
{
  public function generateWord($id, Request $request)
    {
        // استرجاع بيانات الطالب
        $doctorant = Doctorant::findOrFail($id);

        // تحميل القالب
        $template = new TemplateProcessor(public_path('templates/RegistrationCertificate.docx'));

        // تعويض المتغيرات الأساسية
        $template->setValue('NOM', $doctorant->NOMAR);
        $template->setValue('PRENOM', $doctorant->PRENOM);
        $template->setValue('FORMATION', $doctorant->FORMATION);
        $template->setValue('SUJET', $doctorant->SUJET);
        $template->setValue('ENCADRANT', $doctorant->ENCADRANT);
        $template->setValue('DATE', now()->format('d/m/Y'));

        // معالجة أعضاء لجنة المناقشة
        $this->processJuryMembers($doctorant, $template);

        // حفظ الملف
        $fileName = 'Annonce_' . $doctorant->NOMAR . '.docx';
        $savePath = public_path("annonces/$fileName");
        $template->saveAs($savePath);

        // تحميل الملف
        return response()->download($savePath)->deleteFileAfterSend();
    }
     private function processJuryMembers($doctorant, $template)
    {
        for ($i = 1; $i <= 7; $i++) {
            $juryName = trim($doctorant["JURY$i"] ?? '');

            if (!$juryName) {
                // تعويض القيم الفارغة إذا لم يكن هناك عضو في هذا المكان
                $template->setValue("JURY$i", '');
                $template->setValue("DOC$i", '');
                $template->setValue("GRADE$i", '');
                $template->setValue("STATUS$i", '');
                $template->setValue("etablissement_ar$  ",'');

                continue;
            }

            $juryNameNormalized = mb_strtolower($juryName, 'UTF-8');

            // البحث عن الأستاذ حسب الاسم العربي أو الفرنسي
            $prof = Prof::whereRaw('LOWER(nom_prenom_arabe) = ?', [$juryNameNormalized])
                        ->orWhereRaw('LOWER(nom_prenom) = ?', [$juryNameNormalized])
                        ->first();

            // محاولة البحث بتقنية LIKE في حالة عدم وجود تطابق تام
            if (!$prof) {
                $prof = Prof::whereRaw('LOWER(nom_prenom_arabe) LIKE ?', ['%' . $juryNameNormalized . '%'])
                            ->orWhereRaw('LOWER(nom_prenom) LIKE ?', ['%' . $juryNameNormalized . '%'])
                            ->first();
            }

            // إعداد القيم المستخرجة
            $template->setValue("JURY$i", $prof?->nom_prenom_arabe ?? $juryName);
            $template->setValue("DOC$i", $prof ? ($prof->doc ?? ($prof->sexe === 'Féminin' ? 'د.ة' : 'د.')) : 'د.');
            $template->setValue("GRADE$i", trim(($prof?->status_ar ?? 'غير معروف') . ' - ' . ($prof?->etablissement_ar ?? 'غير معروف')));
            $template->setValue("STATUS$i", trim($doctorant["STATUS$i"] ?? ''));
        }
    }
}
