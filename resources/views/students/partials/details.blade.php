<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Personal Information -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">المعلومات الشخصية</h3>
        <div class="space-y-3">
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">CNE:</span>
                <span class="col-span-2 font-medium">{{ $student->CNE }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">CIN:</span>
                <span class="col-span-2 font-medium">{{ $student->CIN }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">الاسم:</span>
                <span class="col-span-2 font-medium">{{ $student->NOM }} {{ $student->PRENOM }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">الاسم العربي:</span>
                <span class="col-span-2 font-medium">{{ $student->NOMAR }} {{ $student->PRENOMAR }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">تاريخ الميلاد:</span>
                <span class="col-span-2 font-medium">{{ $student->DATENAISSANCE?->format('d/m/Y') ?? 'غير محدد' }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">الجنس:</span>
                <span class="col-span-2 font-medium">
                    @if($student->SEXE == 'M') ذكر @elseif($student->SEXE == 'F') أنثى @else غير محدد @endif
                </span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">البريد الإلكتروني:</span>
                <span class="col-span-2 font-medium">{{ $student->EMAIL }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">الهاتف:</span>
                <span class="col-span-2 font-medium">{{ $student->TELEPHONE }}</span>
            </div>
        </div>
    </div>

    <!-- Academic Information -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">المعلومات الأكاديمية</h3>
        <div class="space-y-3">
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">التكوين:</span>
                <span class="col-span-2 font-medium">{{ $student->FORMATION }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">المختبر:</span>
                <span class="col-span-2 font-medium">{{ $student->LABORATOIRE }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">المشرف:</span>
                <span class="col-span-2 font-medium">{{ $student->ENCADRANT }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">المشرف المشارك:</span>
                <span class="col-span-2 font-medium">{{ $student->COENCADRANT }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">موضوع الأطروحة:</span>
                <span class="col-span-2 font-medium">{{ $student->SUJET }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">تاريخ المناقشة:</span>
                <span class="col-span-2 font-medium">{{ $student->DATESOUTENANCE?->format('d/m/Y') ?? 'غير محدد' }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">سنة المناقشة:</span>
                <span class="col-span-2 font-medium">{{ $student->ANNEESOUTENANCE }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <span class="text-gray-500">الحالة:</span>
                <span class="col-span-2">
                    @if($student->SITUATION === 'نشط')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">نشط</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $student->SITUATION ?? 'غير محدد' }}</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Jury Information -->
    <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">لجنة التحكيم</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">العضو</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">الرتبة</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">الحالة</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @for($i = 1; $i <= 7; $i++)
                        @php $jury = 'JURY'.$i; $grade = 'GRADE'.$i; $status = 'STATUS'.$i; @endphp
                        @if(!empty($student->$jury))
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $student->$jury }}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $student->$grade }}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $student->$status }}</td>
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>