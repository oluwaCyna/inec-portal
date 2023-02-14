@extends('layout.app')

@section('content')

<div class="container-md">
    <div class="card">
        <div v class="card-header d-flex gap-2">
            <select class="form-select" onchange="lgaReq(this)" id="state">
                <option selected>Select State</option>
                @foreach($state as $state) 
                <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                @endforeach
            </select>
            <div id="lga"></div>
            <div id="ward"></div>
            <div id="pu"></div>
        </div>
        <div class="card-body">
            <h5 class="card-title" id="state-text"></h5>
            <h5 class="card-title" id="lga-text"></h5>
        </div>
        <div class="card-body">
            <h5 class="text-center" id="result-heading">TOTAL LGA RESULT</h5>
            <div id="result" class="d-flex flex-wrap justify-content-evenly align-items-center gap-2">
                
            </div>
        </div>
        <div class="card-footer" id="see_resp"></div>
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
            let lga = `<select class="form-select" onchange="resultReq(this)" id="lga">
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
                        pdp += parseInt(resp[i][j].party_score);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'DPP') {
                        dpp += parseInt(resp[i][j].party_score);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'ACN') {
                        acn += parseInt(resp[i][j].party_score);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'PPA') {
                        ppa += parseInt(resp[i][j].party_score);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'CDC') {
                        cdc += parseInt(resp[i][j].party_score);
                    }

                    if ('party_abbreviation' in resp[i][j] && resp[i][j].party_abbreviation == 'JP') {
                        jp += parseInt(resp[i][j].party_score);
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