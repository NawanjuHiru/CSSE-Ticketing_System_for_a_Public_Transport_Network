@extends('layouts.default')

@push('styles')
    <style>
        /* .card {
                                                                                                                height: 200px !important;
                                                                                                            } */
    </style>
@endpush

@section('title', 'Routes')
@section('sub_title', 'Add routes')

@section('content')

    @php
        $towns = [
            'Addalaichchenai',
            'Akkarepattu',
            'Alayadivembu',
            'Ampara',
            'Damana',
            'Dehiattakandiya',
            'Irakkamam',
            'Kalmunai',
            'Karaitivu',
            'Lahugala',
            'Maha Oya',
            'Navithanveli',
            'Nintavur',
            'Padiyathalawa',
            'Pottuvil',
            'Sainthamaruthu',
            'Sammanthurai',
            'Uhana',
            'Araiyampathy',
            'Batticaloa',
            'Chenkalady',
            'Eravur',
            'Kaluvanchikudy',
            'Kattankudy',
            'Kiran',
            'Kokkadichcholai',
            'Oddamavadi',
            'Pasikudah',
            'Vakarai',
            'Valaichchenai',
            'Vavunathivu',
            'Vellavely',
            'Gomarankadawala',
            'Kantalai',
            'Kinniya',
            'Kuchchaveli',
            'Morawewa',
            'Muttur',
            'Seruvila',
            'Siripura',
            'Thampalakamam',
            'Trincomalee',
            'Verugal',
            'Anuradhapura',
            'Bulnewa',
            'Eppawala',
            'Galenbindunuwewa',
            'Galnewa',
            'Ganewalpola',
            'Habarana',
            'Horowupotana',
            'Ipalogama',
            'Kahatagasdigiliya',
            'Kebithigollewa',
            'Kebitigollawa',
            'Kekirawa',
            'Konapathirawa',
            'Konwewa',
            'Madatugama',
            'Mahailuppallama',
            'Mahavilachchiya',
            'Maradankadawala',
            'Medawachchiya',
            'Mihintale',
            'Nochchiyagama',
            'Padaviya',
            'Palagala',
            'Palugaswewa',
            'Rajanganaya',
            'Rambewa',
            'Seeppukulama',
            'Talawa',
            'Tambuttegama',
            'Thambuttegama',
            'Thirappane',
            'Yakalla',
            'Aralaganwila',
            'Bakamuna',
            'Dimbulagala',
            'Elahera',
            'Galamuna',
            'Giritale',
            'Hingurakgoda',
            'Jayantipura',
            'Kaduruwela',
            'Lankapura',
            'Manampitiya',
            'Medirigiriya',
            'Minneriya',
            'Polonnaruwa',
            'Sungawila',
            'Welikanda',
            'Badulla',
            'Bandarawela',
            'Beragala',
            'Diyatalawa',
            'Ella',
            'Haldummulla',
            'Hali Ela',
            'Haputale',
            'Kandaketiya',
            'Lunugala',
            'Mahiyanganaya',
            'Meegahakivula',
            'Passara',
            'tennapanguwa',
            'Uva-Paranagama',
            'Welimada',
            'Wiyaluwa',
            'Badalkumbura',
            'Bibile',
            'Buttala',
            'Kataragama',
            'Madulla',
            'Medagama',
            'Moneragala',
            'Okkampitiya',
            'Sevanagala',
            'Siyambalanduwa',
            'Tanamalwila',
            'Wellawaya',
            'Angoda',
            'Athurugiriya',
            'Avissawella',
            'Battaramulla',
            'Boralesgamuwa',
            'Colombo 01',
            'Colombo 02',
            'Colombo 03',
            'Colombo 04',
            'Colombo 05',
            'Colombo 06',
            'Colombo 06',
            'Colombo 07',
            'Colombo 08',
            'Colombo 09',
            'Colombo 10',
            'Colombo 11',
            'Colombo 12',
            'Colombo 13',
            'Colombo 14',
            'Colombo 15',
            'Dehiwala',
            'Hanwella',
            'Homagama',
            'Kaduwela',
            'Kesbewa',
            'Kohuwala',
            'Kolonnawa',
            'Kosgama',
            'Kottawa',
            'Kotte',
            'Maharagama',
            'Malabe',
            'Mount Lavinia',
            'Nawala',
            'Nugegoda',
            'Paddukka',
            'Pannipitiya',
            'Piliyandala',
            'Rajagiriya',
            'Ranala',
            'Ratmalana',
            'Talawathugoda',
            'Wellampitiya',
            'Attanagalla',
            'Biyagama',
            'Delgoda',
            'Divlapitiya',
            'Dompe',
            'Gampaha',
            'Ganemulla',
            'Ja-Ela',
            'Kadawatha',
            'Kandana',
            'Katana',
            'Katunayake',
            'Kelaniya',
            'Kiribathgoda',
            'Mahara',
            'Minuwangoda',
            'Mirigama',
            'Negombo',
            'Nittambuwa',
            'Ragama',
            'Veyangoda',
            'Wattala',
            'Agalawatta',
            'Aluthgama',
            'Baduraliya',
            'Bandaragama',
            'Beruwala',
            'Bulathsinhala',
            'Dodangoda',
            'Horana',
            'Ingiriya',
            'Kalutara',
            'Madurawela',
            'Matugama',
            'Millaniya',
            'Panadura',
            'Wadduwa',
            'Walallavita',
            'Ahangama',
            'Ahungalla',
            'Ambalangoda',
            'Baddegama',
            'Balapitiya',
            'Batapola',
            'Bentota',
            'Boossa',
            'Elpitiya',
            'Galle',
            'Habaraduwa',
            'Hikkaduwa',
            'Hiniduma',
            'Imaduwa',
            'Karandeniya',
            'Karapitiya',
            'Koggala',
            'Kosgoda',
            'Mapalagama',
            'Nagoda',
            'Neluwa',
            'Pitigala',
            'Rathgama',
            'Thawalama',
            'Udugama',
            'Uragasmanhandiya',
            'Wanduramba',
            'Yakkalamulla',
            'Ambalantota',
            'Angunukolapelessa',
            'Beliatta',
            'Hambantota',
            'Middeniya',
            'Tangalla',
            'Tissamaharama',
            'Walasmulla',
            'Weeraketiya',
            'Athuraliya',
            'Akuressa',
            'Aparekka',
            'Denipitiya',
            'Deniyaya',
            'Devinuwara',
            'Dikwella',
            'Gandara',
            'Hakmana',
            'Kamburugamuwa',
            'Kamburupitiya',
            'Karaputugala',
            'Kekanadura',
            'Kirinda',
            'Kotapola',
            'Malimbada',
            'Matara',
            'Mirissa',
            'Morawaka',
            'Mulatiyana',
            'Pasgoda',
            'Pitabeddara',
            'Puhuwella',
            'Thelijjawila',
            'Thihagoda',
            'Tihagoda',
            'Weligama',
            'Welihinda',
            'Welipitiya',
            'Chankanai',
            'Chavakachcheri',
            'Jaffna',
            'Karainagar',
            'Karaveddy',
            'Kayts',
            'Kopay',
            'Maruthankerney',
            'Nallur',
            'Point Pedro',
            'Sandilipay',
            'Tellippalai',
            'Uduvil',
            'Velanai',
            'Iranamadu',
            'Kandavalai',
            'Kilinochchi',
            'Pallai',
            'Paranthan',
            'Poonakary',
            'Velikkandal',
            'Adampan',
            'Chilawathurai',
            'Madhu',
            'Mannar',
            'Nanaddan',
            'Ehatugaswewa',
            'Mullativu',
            'Oddusuddan',
            'Pandiyankulam',
            'Puthukkudiyiruppu',
            'Thunukkai',
            'Vavuniya',
            'Nedunkeni',
            'Cheddikulam',
            'Akurana',
            'Alawatugoda',
            'Ambatenna',
            'Ampitiya',
            'Daskara',
            'Daulagala',
            'Delthota',
            'Digana',
            'Galagedara',
            'Galhinna',
            'Gampola',
            'Gelioya',
            'Hanguranketa',
            'Hapugastalawa',
            'Harispattuwa',
            'Hatharaliyadda',
            'Kadugannawa',
            'Kadugannawa UC',
            'Kandy',
            'Katugastota',
            'Kundasale',
            'Madawala',
            'Madawala Bazaar',
            'Menikdiwela',
            'Minipe',
            'Nawalapitiya',
            'Pallekele',
            'Panvila',
            'Pathadumbara',
            'Pathahewaheta',
            'Peradeniya',
            'Pilimatalawa',
            'Poojapitiya',
            'Pussellawa',
            'Talatuoya',
            'Teldeniya',
            'Thumpane',
            'Udapalatha',
            'Ududumbara',
            'Udunuwara',
            'Ulapane',
            'Watadeniya',
            'Wattegama',
            'Welamboda',
            'Yatinuwara',
            'Dambulla',
            'Elkaduwa',
            'Galewela',
            'Gammaduwa',
            'Inamaluwa',
            'Kaikawala',
            'Kibissa',
            'Laggala Pallegama',
            'Madawala Ulpotha',
            'Matale',
            'Nalanda',
            'Naula',
            'Palapathwela',
            'Pallepola',
            'Rattota',
            'Sigiriya',
            'Ukuwela',
            'Wahacotte',
            'Yatawatta',
            'Agrapatana',
            'Ambewela',
            'Bogawantalawa',
            'Bopattalawa',
            'Dayagama',
            'Ginigathena',
            'Haggala',
            'Hapugastalawa',
            'Hatton',
            'Kotagala',
            'Kotmale',
            'Labukele',
            'Laxapana',
            'Madulla',
            'Maskeliya',
            'Nanuoya',
            'Nuwara Eliya',
            'Padiyapelella',
            'Ragala',
            'Ramboda',
            'Rozella',
            'Talawakele',
            'Udapussallawa',
            'Walapane',
            'Watawala',
            'Ambepussa',
            'Amitirigala',
            'Aranayaka',
            'Bulathkohupitiya',
            'Dehiovita',
            'Deraniyagala',
            'Galigamuwa',
            'Hemmathagama',
            'Karawanella',
            'Kegalle',
            'Kitulgala',
            'Kotiyakumbura',
            'Mawanella',
            'Rambukkana',
            'Ruwanwella',
            'Thalgaspitiya',
            'Warakapola',
            'Yatiyantota',
            'Ayagama',
            'Balangoda',
            'Eheliyagoda',
            'Elapatha',
            'Embilipitiya',
            'Godakawela',
            'Imbulpe',
            'Kahawatta',
            'Kalawana',
            'Kiriella',
            'Kolonne',
            'Kuruwita',
            'Nivitigala',
            'Opanayaka',
            'Panamure',
            'Pelmadulla',
            'Pelmadulla',
            'Pohorabawa',
            'Rakwana',
            'Ratnapura',
            'Weligepola',
            'Alawwa',
            'Bingiriya',
            'Dambadeniya',
            'Dandagamuwa',
            'Galgamuwa',
            'Giriulla',
            'Hettipola',
            'Hiripitiya',
            'Ibbagamuwa',
            'Katupotha',
            'Kuliyapitiya',
            'Kurunegala',
            'Maho',
            'Mawathagama',
            'Melsiripura',
            'Narammala',
            'Nikaweratiya',
            'pahamune',
            'Panagamuwa',
            'Pannala',
            'Pannawa',
            'Polgahawela',
            'Potuhera',
            'Ridigama',
            'Wariyapola',
            'Wawathagama',
            'Yapahuwa',
            'Anamaduwa',
            'Battuluoya',
            'Chilaw',
            'Dankotuwa',
            'Eluvankulam',
            'Kalpitiya',
            'Madampe',
            'Mahawewa',
            'Marawila',
            'Mundel',
            'Nattandiya',
            'Nuraicholai',
            'Palavi',
            'Puttalam',
            'Thillaiyadi',
            'Wennappuwa',
        ];

        $modes = ['Pay as you go', 'Season ticket'];

        if ($action != 'add') {
            $id = $data['route']->routeId;
        } else {
            $id = '';
        }

    @endphp

    <form action="{{ route('route_create', ['action' => $action, 'id' => $id]) }}" method="POST" class="login-form"
        id="form_id">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Route Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('routeNo') has-danger @enderror">
                                    <label>Route No</label><span class="text-danger" data-placement="top"
                                        data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                    <input class="form-control" placeholder="Enter your route no" type="text"
                                        name="routeNo"
                                        @if (!empty(old('routeNo'))) value="{{ old('routeNo') }}" @elseif($action != 'add') value="{{ $data['route']->routeNo }}" @endif>
                                    @error('routeNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('startPoint') has-danger @enderror">
                                    <label>Start Point</label><span class="text-danger" data-placement="top"
                                        data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                    <select class="form-control select2" name="startPoint">
                                        <option value=" ">
                                            Select start point
                                        </option>
                                        @foreach ($towns as $town)
                                            <option value="{{ $town }}"
                                                @if (!empty(old('startPoint')) && old('startPoint') == $town) selected @elseif($action != 'add' && $town == $data['route']->startPoint) selected @endif>
                                                {{ $town }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('startPoint')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('price') has-danger @enderror">
                                    <label>Price (Rs.)</label><span class="text-danger" data-placement="top"
                                        data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                    <input class="form-control" placeholder="Enter your price" type="number" name="price"
                                        @if (!empty(old('price'))) value="{{ old('price') }}" @elseif($action != 'add') value="{{ $data['route']->price }}" @endif>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('mode') has-danger @enderror">
                                    <label>Mode of Ticket</label><span class="text-danger" data-placement="top"
                                        data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                    <select class="form-control select2" name="mode">
                                        <option value=" ">
                                            Select mode of ticket
                                        </option>
                                        @foreach ($modes as $mode)
                                            <option value="{{ $mode }}"
                                                @if (!empty(old('mode')) && old('mode') == $mode) selected @elseif($action != 'add' && $mode == $data['route']->mode) selected @endif>
                                                {{ $mode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('endpoint') has-danger @enderror">
                                    <label>End Point</label><span class="text-danger" data-placement="top"
                                        data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                    <select class="form-control select2" name="endpoint">
                                        <option value=" ">
                                            Select end point
                                        </option>
                                        @foreach ($towns as $town)
                                            <option value="{{ $town }}"
                                                @if (!empty(old('endpoint')) && old('endpoint') == $town) selected @elseif($action != 'add' && $town == $data['route']->endpoint) selected @endif>
                                                {{ $town }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('endpoint')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row card-footer mt-4">
                            <div class="col-md-12 text-right">
                                <div class="form-group col-md-12">
                                    <button type="submit" id="save" data-toggle="tooltip-primary" data-placement="top"
                                        title="Save route"
                                        class="btn btn-success text-white">{{ $action == 'edit' ? 'Update' : 'Save' }}</button>
                                    <button type="button" id="clear" data-toggle="tooltip-primary" data-placement="top"
                                        title="Clear the form" class="btn btn-secondary">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card custom-card" style="height: 28rem;">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Vehicles</h6>
                        <div class="row">
                            <div class="col-md-8">
                                <input class="form-control mb-3" id="search" onkeyup="myFunction()"
                                    placeholder="Search vehicle" type="text" name="search">
                            </div>
                            <div class="col-md-12 table-responsive overflow-auto" style="height: 19rem;">
                                <table class="table table-borderless" id="zero_config">
                                    <thead>
                                        <tr>
                                            <th scope="col" hidden>#</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($data['vehicle'] as $res)
                                        <tr>
                                            <td scope="col" hidden>{{ $res->vehicleId }}</td>
                                            <td scope="col">
                                                <input type="checkbox" style="width: 25px; height: 16px;"
                                                    data-id="{{ $res->vehicleId }}"
                                                    @if ($action != 'add') @foreach ($data['vehecle_route'] as $vroute)
                                                    @if ($vroute->vehicleId == $res->vehicleId)
                                                        checked
                                                    @else @endif
                                                    @endforeach
                                            @else
                                    @endif
                                    class="form-control" name="vehicle[]" value="{{ $res->vehicleId }}">
                                    </td>
                                    <td scope="col">{{ $res->vehicleNumber }}</td>
                                    <td scope="col">{{ $res->company }}</td>
                                    </tr>
                                    @php
                                        $x++;
                                    @endphp
                                    @endforeach
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').css('width', '100%');
            $(document).on('click', '#clear', function(e) {
                e.preventDefault();
                $('input[type=text]').val("");
                $('input[type=checkbox]').prop('checked', false);
                $('input[type=number]').val("");
                $('.select2').val(' ');
                $('.select2').trigger('change');
                $('.select2').css('width', '100%');
            });
        });

        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("zero_config");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                var x = $("#search").val();
                var regex = /^[a-zA-Z]+$/;
                if (!x.match(regex)) {
                    td = tr[i].getElementsByTagName("td")[2];
                }
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endpush
