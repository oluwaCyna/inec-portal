@extends('layout.app')

@section('content')

<div class="container-md">
    <div class="card">
        <div class="card-header d-flex gap-2">
            <select class="form-select unit-input"  onchange="lgaReq(this)" id="state">
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
            <h5 class="card-title" id="ward-text"></h5>
            <h5 class="card-title" id="pu-text"></h5>
        </div>
        <div class="card-body">
            <h5 class="text-center" id="result-heading">RESULTS</h5>
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
            let lga = `<select class="form-select" onchange="wardReq(this)" id="lga">
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


    function wardReq(e){
      $.ajax({
        type:'POST',
        url:'/request/ward',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ e.value,
        success:function(resp){
            wardArray = resp.ward;
            let wardOpt='';
            let ward = `<select class="form-select" onchange="puReq(this)" id="ward">
                <option selected id="ward-default">Select Ward</option>
            </select>`;
            $("#ward").replaceWith(ward);
            for (var i=0; i<wardArray.length; i++) {
                wardOpt += `<option value="${wardArray[i].ward_id},${wardArray[i].lga_id}">${wardArray[i].ward_name}</option>`;
            }
            $("#ward-default").after(wardOpt);
            $('#lga-text').text(`Local Govt Area: ${e.options[e.selectedIndex].text}`);
        }
      });
    }


    function puReq(e){
      $.ajax({
        type:'POST',
        url:'/request/pu',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ e.value,
        success:function(resp){
            puArray = resp.pu;
            let puOpt='';
            let pu = `<select class="form-select" onchange="resultReq(this)" id="pu">
                <option selected id="pu-default">Select Polling Unit</option>
            </select>`;
            $("#pu").replaceWith(pu);
            for (var i=0; i<puArray.length; i++) {
                puOpt += `<option value="${puArray[i].uniqueid}">${puArray[i].polling_unit_name}</option>`;
            }
            $("#pu-default").after(puOpt);
            $('#ward-text').text(`Ward: ${e.options[e.selectedIndex].text}`);
        }
      });
    }

    function resultReq(e){
      $.ajax({
        type:'POST',
        url:'/request/result',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ e.value,
        success:function(resp){
            resultArray = resp.result;
            let resultCard='';
            for (var i=0; i<resultArray.length; i++) {
                resultCard += `<div class="p-3 bg-info text-center rounded" style="width:30%;>
                            <h3 class="">${resultArray[i].party_abbreviation}</h3>
                            <h1 class="">${resultArray[i].party_score} votes</h1>
                            </div>`;
            }
            $("#result-heading").show();
            $("#result").empty();
            $("#result").html(resultCard);
            $('#pu-text').text(`Polling Unit: ${e.options[e.selectedIndex].text}`);
            $("#dummy-result").hide();
        }
      });
    }
    
    </script>
@endsection