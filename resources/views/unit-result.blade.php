@extends('layout.app')

@section('content')

<div class="container">
    <div class="card mx-5">
        <div class="card-header d-flex gap-2">
            <select class="form-select" style="width:20%" onchange="lgaReq(this.value)" id="state">
                <option selected>Open this select menu</option>
                <option value="25">Delta State</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div id="lga"></div>
            <div id="ward"></div>
            <div id="pu"></div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted ">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            b5
        </div>
        <div class="card-footer" id="see_resp"></div>
    </div>
</div>

@endsection

@section('script')

<script>

    function lgaReq(id){
      $.ajax({
        type:'POST',
        url:'/request/lga',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ id,
        success:function(resp){
            lgaArray = resp.lga;
            let lgaOpt='';
            let lga = `<select class="form-select" style="width:20%" onchange="wardReq(this.value)" id="lga">
                <option selected id="lga-default">Open this select menu</option>
            </select>`;
            $("#lga").replaceWith(lga);
            for (var i=0; i<lgaArray.length; i++) {
                lgaOpt += `<option value="${lgaArray[i].lga_id}">${lgaArray[i].lga_name}</option>`;
            }
            $("#lga-default").after(lgaOpt);
        //   $('#see_resp').html(JSON.stringify(resp));
        }
      });
    }


    function wardReq(id){
      $.ajax({
        type:'POST',
        url:'/request/ward',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ id,
        success:function(resp){
            wardArray = resp.ward;
            let wardOpt='';
            let ward = `<select class="form-select" style="width:20%" onchange="puReq(this.value)" id="ward">
                <option selected id="ward-default">Open this select menu</option>
            </select>`;
            $("#ward").replaceWith(ward);
            for (var i=0; i<wardArray.length; i++) {
                wardOpt += `<option value="${wardArray[i].ward_id},${wardArray[i].lga_id}">${wardArray[i].ward_name}</option>`;
            }
            $("#ward-default").after(wardOpt);
        //   $('#see_resp').html(JSON.stringify(resp));
        }
      });
    }


    function puReq(id){
      $.ajax({
        type:'POST',
        url:'/request/pu',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        data:'id='+ id,
        success:function(resp){
            puArray = resp.pu;
            console.log(puArray);
            let puOpt='';
            let pu = `<select class="form-select" style="width:20%" onchange="" id="">
                <option selected id="pu-default">Open this select menu</option>
            </select>`;
            $("#pu").replaceWith(pu);
            for (var i=0; i<puArray.length; i++) {
                puOpt += `<option value="${puArray[i].uniqueid}">${puArray[i].polling_unit_name}</option>`;
            }
            $("#pu-default").after(puOpt);
        //   $('#see_resp').html(JSON.stringify(resp));
        }
      });
    }
    
    </script>
@endsection