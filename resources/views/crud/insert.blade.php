@extends('layouts')
@section('content')

<form id="Newmassage">
@csrf
    <div class="form-group">
      <label for="exampleInputEmail1">email</label>
      <input type="text" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">massage</label>
        <input type="text" id="massage" class="form-control" >
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

 <table class="table" id="dev_table_1">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">massage</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $data)
              <tr id="row{{$data->id}}">
                  <td>{{$data->id}}</td>
                  <td>{{$data->email}}</td>
                  <td>{{$data->massage}}</td>
                  <td>
                    <button type="button" onclick="delete_m({{$data->id}})"  class="btn btn-outline-danger">delete</button>
                    <button type="button" onclick="edit_m({{$data->id}})"  class="btn btn-outline-primary">edit</button>
                  </td>
              </tr>
        @endforeach
    </tbody>
  </table>
  <div id="dev_table_2"></div>

  <script>
    function aj(){
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                    });
    }
  </script>
  <script>
    $("#Newmassage").submit(function(e){
        e.preventDefault();
        let email=$("#email").val();
        let massage=$("#massage").val();
            aj();
          $.ajax({
            url:"{{url('/add')}}",
            type:"POST",
            data:{
                email:email,
                massage:massage
            },
        success:(d)=>{
            if(d){
                $("#dev_table_1 tbody").prepend(`
                <tr id="row${d.id}">
                  <td>${d.id}</td>
                  <td>${d.email}</td>
                  <td>${d.massage}</td>
                  <td>
                    <button type='button' onclick="delete_m(${d.id})" class='btn btn-outline-danger'>
                      delete
                    </button>
                    <button type="button" onclick="edit_m(${d.id})"  class="btn btn-outline-primary">
                      edit
                    </button>
                  </td>
                </tr>
                `);
            }}});
    });
    </script>
    <script>
       function delete_m(id){
        aj();
      $.ajax({
            url:"{{url('/delete')}}"+"/"+id,
            type:"DELETE",
        success:(r)=>{
                $("#row"+r.id).remove();  
            }});
    }
    </script>
    <script>
      function edit_m(id){
        aj();
      $.ajax({
            url:"{{url('/view')}}"+"/"+id,
            type:"GET",
        success:(r)=>{
               $('#dev_table_2')
               .prepend(`<form  id="Upmassage" onsubmit="event.preventDefault(); ap();">
                          <input type="hidden" id="id2"  value="${r.id}" class="form-control">
                              <div class="form-group">
                                <label for="exampleInputEmail1">email</label>
                                <input type="text" id="email2" value="${r.email}" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">massage</label>
                                  <input type="text" id="massage2" value="${r.massage}" class="form-control" >
                              </div>
                              <button type="submit"  class="btn btn-primary">update</button>
                    </form>
               `);
              }
            }
          );
        }
    </script>
    <script >

            function ap(){
            let id=$('#id2').val();
            let email=$('#email2').val();
            let massage=$('#massage2').val();
                
        aj();
      $.ajax({
            url:"{{url('/edit')}}",
            type: "POST",
            data:{
                  id:id,
                  email:email,
                  massage:massage
            },
        success:(dk)=>{
          $("#Upmassage").remove();
             
            }
            });
    
      };
    </script>

@endsection