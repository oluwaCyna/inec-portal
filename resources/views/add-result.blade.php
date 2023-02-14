@extends('layout.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Add New Record') }}</div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            <script>
                $(".alert").alert();
            </script>

            <form method="POST" action="{{ route('vote.store') }}">
                @csrf

                <div class="row mb-3">
                    <label for="polling_unit_number"
                        class="col-md-4 col-form-label text-md-end">{{ __('Polling unit number') }}</label>

                    <div class="col-md-6">
                        <input id="polling_unit_number" type="text"
                            class="form-control @error('polling_unit_number') is-invalid @enderror" name="polling_unit_number"
                            value="{{ old('polling_unit_number') }}" autocomplete="polling_unit_number"
                            autofocus>

                        @error('polling_unit_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="party_abbreviation"
                        class="col-md-4 col-form-label text-md-end">{{ __('Name of party') }}</label>

                    <div class="col-md-6">
                        <select id="party_abbreviation" class="form-select @error('party_abbreviation') is-invalid @enderror" name="party_abbreviation"
                         autocomplete="party_abbreviation"
                        autofocus>
                            <option selected value="{{ old('party_abbreviation') }}">{{ old('party_abbreviation' ?? 'Select party') }}</option>
                            <option value="PDP">PDP</option>
                            <option value="DPP">DPP</option>
                            <option value="ACN">ACN</option>
                            <option value="PPA">PPA</option>
                            <option value="CDC">CDC</option>
                            <option value="JP">JP</option>
                        </select>

                        @error('party_abbreviation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="party_vote"
                        class="col-md-4 col-form-label text-md-end">{{ __('Number of vote(s)') }}</label>

                    <div class="col-md-6">
                        <input id="party_vote" type="number"
                            class="form-control @error('party_vote') is-invalid @enderror" name="party_vote"
                            value="{{ old('party_vote') }}" autocomplete="party_vote"
                            autofocus>

                        @error('party_vote')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="admin_name"
                        class="col-md-4 col-form-label text-md-end">{{ __('Submitted by') }}</label>

                    <div class="col-md-6">
                        <input id="admin_name" type="text"
                            class="form-control @error('admin_name') is-invalid @enderror" name="admin_name"
                            value="{{ old('admin_name') }}" autocomplete="admin_name"
                            autofocus>

                        @error('admin_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit result') }}
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $("#result-heading").hide();
    function lgaReq(e){
      $.ajax({
        type:'POST',
        url:'/request/lga',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ e.value,
        success:function(resp){
            lgaArray = resp.lga;
            let lgaOpt='';
            let lga = `<select class="form-select" style="width:50%" onchange="resultReq(this)" id="lga">
                <option selected id="lga-default">Select LGA</option>
            </select>`;
            $("#lga").replaceWith(lga);
            for (var i=0; i<lgaArray.length; i++) {
                lgaOpt += `<option value="${lgaArray[i].lga_id}">${lgaArray[i].lga_name}</option>`;
            }
            $("#lga-default").after(lgaOpt);
          $('#state-text').text(`State: ${e.options[e.selectedIndex].text}`);
        }
      });
    }

    function resultReq(e){
        let pdp = dpp = acn = ppa = cdc = jp = 0;
      $.ajax({
        type:'POST',
        url:'/request/total',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ e.value,
        success:function(resp){
            for (let i = 0; i < resp.length; i++) {
                for (let j = 0; j < resp[i].length; j++) {
                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'PDP') {
                        pdp += parseInt(resp[i][j].party_vote);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'DPP') {
                        dpp += parseInt(resp[i][j].party_vote);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'ACN') {
                        acn += parseInt(resp[i][j].party_vote);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'PPA') {
                        ppa += parseInt(resp[i][j].party_vote);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'CDC') {
                        cdc += parseInt(resp[i][j].party_vote);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'JP') {
                        jp += parseInt(resp[i][j].party_vote);
                    }
                }
                
            }
            resultArray = [
                {name: 'PDP',vote: pdp},
                {name: 'DPP',vote: dpp},
                {name: 'ACN',vote: acn},
                {name: 'PPA',vote: ppa},
                {name: 'CDC',vote: cdc},
                {name: 'JP',vote: jp},
            ];
            let resultCard='';
            for (var i=0; i<resultArray.length; i++) {
                resultCard += `<div class="p-3 bg-info text-center rounded" style="width:30%;">
                            <h3>${resultArray[i].name}</h3>
                            <h1 class="">${resultArray[i].vote} votes</h1>
                            </div>`;
            }
            $("#result-heading").show();
            $("#result").empty();
            $("#result").html(resultCard);
            $('#lga-text').text(`Local Govt Area: ${e.options[e.selectedIndex].text}`);
            $("#dummy-result").hide();
        },
      });
    }
    
    </script>
@endsection