@extends('layouts.app')
@section('Title','Ajouter un Professeur')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5">
                <h1 class="text-2xl font-bold text-white">Ajouter un Professeur</h1>
            </div>

            <!-- Form Content -->
            <form action="{{ route('profs.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- LEFT COLUMN - Personal Info -->
                    <div class="space-y-6">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Informations Personnelles
                        </h2>

                        <!-- Name -->
                        <div>
                            <label for="nom_prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom Complet</label>
                            <input type="text" name="nom_prenom" id="nom_prenom" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Arabic Name -->
                        <div>
                            <label for="nom_prenom_arabe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الاسم الكامل</label>
                            <input type="text" name="nom_prenom_arabe" id="nom_prenom_arabe" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 text-right" dir="rtl">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email_professionnel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email_professionnel" id="email_professionnel" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="numero_telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                            <input type="tel" name="numero_telephone" id="numero_telephone" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sexe</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sexe" value="M" class="h-4 w-4 text-blue-600 dark:text-blue-500">
                                    <span class="ml-2 dark:text-gray-300">Masculin</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sexe" value="F" class="h-4 w-4 text-blue-600 dark:text-blue-500">
                                    <span class="ml-2 dark:text-gray-300">Féminin</span>
                                </label>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <!-- <div>
                            <label for="date_naissance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de Naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div> -->

                        <!-- Nationality -->
                        <!-- <div>
                            <label for="nationalite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nationalité</label>
                            <input type="text" name="nationalite" id="nationalite"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div> -->
                           <!-- Doc -->
                        <div>
                            <label for="doc" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Doc</label>
                            <input type="text" name="doc" id="doc"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>
                            <!-- Laboratory -->
                        <div>
                            <label for="laboratoire" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Laboratoire</label>
                            <input type="text" name="laboratoire" id="laboratoire"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>
                    </div>

                    <!-- RIGHT COLUMN - Academic Info -->
                    <div class="space-y-6">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Informations Académiques
                        </h2>

                        <!-- Grade -->
                        <div>
                            <label for="grade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grade</label>
                            <input type="text" name="grade" id="grade" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Arabic Grade -->
                        <div>
                            <label for="grade_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الرتبة</label>
                            <input type="text" name="grade_ar" id="grade_ar" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 text-right" dir="rtl">
                        </div>

                        <!-- Department -->
                        <div>
                            <label for="departement" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Département</label>
                            <input type="text" name="departement" id="departement" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Arabic Department -->
                        <div>
                            <label for="departement_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">القسم</label>
                            <input type="text" name="departement_ar" id="departement_ar" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 text-right" dir="rtl">
                        </div>

                        <!-- Institution -->
                        <div>
                            <label for="etablissement_fr" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Établissement</label>
                            <input type="text" name="etablissement_fr" id="etablissement_fr" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <!-- Arabic Institution -->
                        <div>
                            <label for="etablissement_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">المؤسسة</label>
                            <input type="text" name="etablissement_ar" id="etablissement_ar" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 text-right" dir="rtl">
                        </div>

                        <!-- Professor Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                            <select name="type" id="type" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                                <option value="Permanent">Permanent</option>
                                <option value="Visiting">Visiting</option>
                                <option value="Associate">Associate</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <input type="text" name="status" id="status"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        </div>
                        <div>
                            <label for="status_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الحالة</label>
                            <input type="text" name="status_ar" id="status_ar"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 text-right" dir="rtl">
                        </div></div>




                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('profs.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
