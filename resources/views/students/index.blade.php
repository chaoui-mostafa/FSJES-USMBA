@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="mb-4">رفع ملف الطلاب</h1>

    <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">رفع</button>
    </form>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>NUMERO</th>
            <th>CNE</th>
            <th>CIN</th>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>NOMAR</th>
            <th>PRENOMAR</th>
            <th>DATENAISSANCE</th>
            <th>LIEUNAISSANCE</th>
            <th>LIEUNAISSANCEAR</th>
            <th>NATIONALITE</th>
            <th>EMAIL</th>
            <th>TELEPHONE</th>
            <th>SEXE</th>
            <th>IMAGE</th>
            <th>FONCTIONNAIRE</th>
            <th>BOURSE</th>
            <th>PROMO</th>
            <th>FORMATION</th>
            <th>LABORATOIRE</th>
            <th>SUJET</th>
            <th>ENCADRANT</th>
            <th>COENCADRANT</th>
            <th>DATESOUTENANCE</th>
            <th>ANNEESOUTENANCE</th>
            <th>REMARQUE</th>
            <th>SITUATION</th>
            <th>THESE</th>
            <th>RAPPORTEUR1</th>
            <th>EtatRapporteur1</th>
            <th>DateDeDepotRapport1</th>
            <th>RAPPORTEUR2</th>
            <th>EtatRapporteur2</th>
            <th>DateDeDepotRapport2</th>
            <th>RAPPORTEUR3</th>
            <th>EtatRapporteur3</th>
            <th>DateDeDepotRapport3</th>
            <th>JURY1</th>
            <th>GRADE1</th>
            <th>STATUS1</th>
            <th>JURY2</th>
            <th>GRADE2</th>
            <th>STATUS2</th>
            <th>JURY3</th>
            <th>GRADE3</th>
            <th>STATUS3</th>
            <th>JURY4</th>
            <th>GRADE4</th>
            <th>STATUS4</th>
            <th>JURY5</th>
            <th>GRADE5</th>
            <th>STATUS5</th>
            <th>JURY6</th>
            <th>GRADE6</th>
            <th>STATUS6</th>
            <th>JURY7</th>
            <th>GRADE7</th>
            <th>STATUS7</th>
            <th>MENTIONFR</th>
            <th>MENTIONAR</th>
            <th>upload_id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->NUMERO }}</td>
                <td>{{ $student->CNE }}</td>
                <td>{{ $student->CIN }}</td>
                <td>{{ $student->NOM }}</td>
                <td>{{ $student->PRENOM }}</td>
                <td>{{ $student->NOMAR }}</td>
                <td>{{ $student->PRENOMAR }}</td>
                <td>{{ $student->DATENAISSANCE }}</td>
                <td>{{ $student->LIEUNAISSANCE }}</td>
                <td>{{ $student->LIEUNAISSANCEAR }}</td>
                <td>{{ $student->NATIONALITE }}</td>
                <td>{{ $student->EMAIL }}</td>
                <td>{{ $student->TELEPHONE }}</td>
                <td>{{ $student->SEXE }}</td>
                <td>{{ $student->IMAGE }}</td>
                <td>{{ $student->FONCTIONNAIRE }}</td>
                <td>{{ $student->BOURSE }}</td>
                <td>{{ $student->PROMO }}</td>
                <td>{{ $student->FORMATION }}</td>
                <td>{{ $student->LABORATOIRE }}</td>
                <td>{{ $student->SUJET }}</td>
                <td>{{ $student->ENCADRANT }}</td>
                <td>{{ $student->COENCADRANT }}</td>
                <td>{{ $student->DATESOUTENANCE }}</td>
                <td>{{ $student->ANNEESOUTENANCE }}</td>
                <td>{{ $student->REMARQUE }}</td>
                <td>{{ $student->SITUATION }}</td>
                <td>{{ $student->THESE }}</td>
                <td>{{ $student->RAPPORTEUR1 }}</td>
                <td>{{ $student->EtatRapporteur1 }}</td>
                <td>{{ $student->DateDeDepotRapport1 }}</td>
                <td>{{ $student->RAPPORTEUR2 }}</td>
                <td>{{ $student->EtatRapporteur2 }}</td>
                <td>{{ $student->DateDeDepotRapport2 }}</td>
                <td>{{ $student->RAPPORTEUR3 }}</td>
                <td>{{ $student->EtatRapporteur3 }}</td>
                <td>{{ $student->DateDeDepotRapport3 }}</td>
                <td>{{ $student->JURY1 }}</td>
                <td>{{ $student->GRADE1 }}</td>
                <td>{{ $student->STATUS1 }}</td>
                <td>{{ $student->JURY2 }}</td>
                <td>{{ $student->GRADE2 }}</td>
                <td>{{ $student->STATUS2 }}</td>
                <td>{{ $student->JURY3 }}</td>
                <td>{{ $student->GRADE3 }}</td>
                <td>{{ $student->STATUS3 }}</td>
                <td>{{ $student->JURY4 }}</td>
                <td>{{ $student->GRADE4 }}</td>
                <td>{{ $student->STATUS4 }}</td>
                <td>{{ $student->JURY5 }}</td>
                <td>{{ $student->GRADE5 }}</td>
                <td>{{ $student->STATUS5 }}</td>
                <td>{{ $student->JURY6 }}</td>
                <td>{{ $student->GRADE6 }}</td>
                <td>{{ $student->STATUS6 }}</td>
                <td>{{ $student->JURY7 }}</td>
                <td>{{ $student->GRADE7 }}</td>
                <td>{{ $student->STATUS7 }}</td>
                <td>{{ $student->MENTIONFR }}</td>
                <td>{{ $student->MENTIONAR }}</td>
                <td>{{ $student->upload_id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
