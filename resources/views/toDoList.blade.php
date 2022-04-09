@extends('layouts.toDo')

@section('css')
<style>
    *{
        box-sizing: border-box;
    }
    body{
        height: 100vh;
        width: 100%;
        background: linear-gradient(to bottom, #68EACC 0%, #4978E8 100%);
    }
    .wrapper{
        margin: 120px auto;
        max-width: 400px;
        width: 100%;
        background: #fff ;
        padding: 25px;
        border-radius: 5px ;
    }
    .wrapper .header{
        text-align: center;
        font-size: 23px;
        font-weight: 600;
    }
    .wrapper .inputField{
        height: 45px;
        width: 100%;
    }
    .inputField input{
        width: 100%;
        height: 100%;
        border: 1px solid #ccc;
        font-size: 17px;
        border-radius: 3px;
        padding-left: 15px;
    }
    .btn{
        border-radius: 5px;
        background: skyblue;
        margin-top: 11px;
    }
    .heading{
        text-align: center;
    }
    .todo-list>ul>li{
        font-size: 18px;
    }
</style>
@endsection

@section('content')
<div class="container" bis_skin_checked="1">
        <div class="wrapper">
            <!-- Task Name -->
            <div class="form-group" bis_skin_checked="1">
                <label class="header" for="task" class="col-md-3 control-label">Task</label>
                <div class="col-md-12 inputField" bis_skin_checked="1">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>
            <!-- DeadLine -->
            <div class="form-group" bis_skin_checked="1">
                <label class="header" for="task" class="col-md-3 control-label">Deadline</label>
                <div class="col-md-12 inputField" bis_skin_checked="1">
                    <input type="datetime-local" id="task-deadline" name="task-deadline" value="">
                </div>
            </div>
            <hr>
            <!-- Add Task Button -->
            <div class="form-group" bis_skin_checked="1">
                <div class="col-sm-offset-3 col-sm-6" bis_skin_checked="1">
                    <button class="btn" type="button" class="btn btn-default" id="add-task">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
            <div class="container todo-list" bis_skin_checked="1">
                <h3 class="heading">To Do List</h3>
                 <ul>
                    @foreach($returnData as $value)
                    <li> <b>{{ $value['task_name'] }} - Deadline: {{ $value['deadline'] }}</b> </li>
                    @endforeach
                </ul>
            </div>
        </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).on('click', "#add-task", ()=>{
        let task_name = $("#task-name").val();
        let deadline = $("#task-deadline").val();
        if(!task_name){
            alert("Kindly Enter Task");
            return false;
        }
        if(!deadline){
            alert("Kindly Enter Task Deadline");
            return false;
        }
        $.ajax({
            url: "<?= route('addTask') ?>",
            dataType: 'json',
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                task_name:task_name,
                deadline:deadline
            },
            success: function (data) { 
                location.reload();
            }, 
            error: function (e) {
                alert('Something Went Wrong');
            }
        });
    });
</script>
@endsection