@extends('layouts.appsidebar')

@section('content')

<div class="app-content content dashboard">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-dashboard">
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="trainings.php"><h2 class="mb-0"><i class="fas fa-angle-left"></i> Create Quiz</h2></a>
                                            <p class="grey-text mt-3">Quiz Type</p>
                                            <form action="#" class="d-flex">
                                                <p class="mr-sm-4 mr-1">
                                                    <input type="radio" id="test1" name="radio-group" checked>
                                                    <label for="test1">Enable Time Based</label>
                                                </p>
                                                <p>
                                                    <input type="radio" id="test2" name="radio-group">
                                                    <label for="test2">Normal</label>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 mt-1 col-sm-3"><p class="l-grey-text mb-0">Duration</p></div>
                                        <div class="col-lg-3 mt-1 col-sm-4"><input type="number" name="" value="10" class="site-input" id=""></div>
                                        <div class="col-lg-6 mt-1 col-sm-5 col-xl-4">
                                            <select name="" id="" class="site-input">
                                                <option value="">Minute(s)</option>
                                                <option value="">Hour(s)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            
                                            <div class="resource-card pt-2 pb-4 pl-md-3 pl-1 pr-1">
                                              @foreach($quizes as $quiz)
                                                <div class=" mt-3">
                                                    <div class="resource-inner-card mr-2 py-3">
                                                        <div class="row">
                                                            <div class="col-xl-4 text-center my-auto">
                                                                <img src="images/quiz.png" alt="" class="img-fluid">
                                                            </div>
                                                            <div class="col-xl-8 mt-2">
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="l-grey-text mb-0">{{$quiz->question_number}}:
                                                                        {{$quiz->question}}</p>                                                                     
                                                                    <div class="btn-group custom-dropdown ml-2 mb-1">
                                                                        <button type="button" class="btn btn-drop-table btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></button>
                                                                        <div class="dropdown-menu custom-dropdown"> 
                                                                            <a href="#_" class="dropdown-item" data-toggle="modal" data-target=".editQuestion"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                                            <a href="#_" class="dropdown-item" data-toggle="modal" data-target=".deleteQuestion"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <p>
                                                                        <input type="radio" id="test3" name="radio-group" checked>
                                                                        <label for="test3">{{$quiz->option1}}</label>
                                                                    </p>
                                                                    <p>
                                                                        <input type="radio" id="test4" name="radio-group">
                                                                        <label for="test4">{{$quiz->option2}}</label>
                                                                    </p>
                                                                    <p>
                                                                        <input type="radio" id="test5" name="radio-group" checked>
                                                                        <label for="test5">{{$quiz->option3}}</label>
                                                                    </p>
                                                                    <p>
                                                                        <input type="radio" id="test6" name="radio-group">
                                                                        <label for="test6">{{$quiz->option4}}</label>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                                <div class="mt-5">
                                                    <a href="#_" class="site-btn px-4" data-toggle="modal" data-target=".addQuestion"><i class="fas fa-plus-circle"></i> Add</a>
                                                </div>
                                            </div>
                                            <div class="pt-3 pb-5">
                                                <form action="training-details.php">
                                                    <button class="px-5 mx-auto login-btn">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade addQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-left">
                <form method="post" action="{{ route('quizes.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                 @csrf   
                    
                    <input type="hidden" name="training_id" class="site-input w-100" value="{{$training_id}}">

                    <p class="modal-heading text-center">Add Question</p>
                    <p class="mt-1 black-text mb-0">{{$quiz->question_number}}:</p>
                    <textarea name="question" id="" cols="30" rows="5" class="w-100 site-input" placeholder="Enter Question" required></textarea>
                    <p class="mt-2 black-text mb-0">Upload Image:</p>
                    <div class="d-flex">
                     
                            <div id="yourBtn" onclick="getFile()" class="mr-2">
                                 <input style="height:200px;position:absolute;padding: 87px 0px 87px 0px;opacity: 0;" name="image" type="file" value="upload" required/>
                                 <img src="{{asset('images/training-details-2.png')}}" alt="" class="img-fluid">
                            </div>
                            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" value="upload" onchange="sub(this)" /></div>
                        
                    </div>
                    <p class="mt-1 black-text mb-0">Options:</p>
                    <div class="mt-2">
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test27" name="radio_group" value="1">
                                <label for="test27"></label>
                            </p>
                            <input name="option1" type="text" class="w-100 site-input" value="Option 1" placeholder="Enter Option 1">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test28" name="radio_group" value="2">
                                <label for="test28"></label>
                            </p>
                            <input name="option2" type="text" class="w-100 site-input" value="Option 2" placeholder="Enter Option 2">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test29" name="radio_group" value="3">
                                <label for="test29"></label>
                            </p>
                            <input name="option3" type="text" class="w-100 site-input" value="Option 3" placeholder="Enter Option 3">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test30" name="radio_group" value="4">
                                <label for="test30"></label>
                            </p>
                            <input name="option4" type="text" class="w-100 site-input" value="Option 4" placeholder="Enter Option 4">
                        </div>
                        <p class="mt-1 black-text mb-0">Note: Select the correct answer</p>
                    </div>
                    <div class="modal-btn-div mt-2">
                        <button type="submit" class="login-btn px-5" >Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade editQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-left">
                <form action="create-quiz.php">
                    <p class="modal-heading text-center">Edit Question</p>
                    <p class="mt-1 black-text mb-0">Q3:</p>
                    <textarea name="" id="" cols="30" rows="5" class="w-100 site-input" placeholder="Enter Question">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore.</textarea>
                    <p class="mt-2 black-text mb-0">Upload Image:</p>
                    <div class="d-flex">
                        <form action="#type your action here" method="POST" enctype="multipart/form-data" name="myForm">
                            <div id="yourBtn" onclick="getFile()" class="mr-2">
                                <img src="images/training-details-2.png" alt="" class="img-fluid">
                            </div>
                            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" value="upload" onchange="sub(this)" /></div>
                        </form>
                        <div class="position-relative">
                            <img src="images/training-details.png" alt="" class="img-fluid w-100">
                            <span class="rounded-circle cancel-btn border-0 p-0"><i class="fas l-grey-text fa-times-circle"></i></span>
                        </div>
                    </div>
                    <p class="mt-1 black-text mb-0">Options:</p>
                    <div class="mt-2">
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test27" name="radio-group">
                                <label for="test27"></label>
                            </p>
                            <input type="text" class="w-100 site-input" value="Option 1" placeholder="Enter Option 1">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test28" name="radio-group">
                                <label for="test28"></label>
                            </p>
                            <input type="text" class="w-100 site-input" value="Option 2" placeholder="Enter Option 2">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test29" name="radio-group" checked>
                                <label for="test29"></label>
                            </p>
                            <input type="text" class="w-100 site-input" value="Option 3" placeholder="Enter Option 3">
                        </div>
                        <div class="mb-1 d-flex align-items-center">
                            <p class="mr-2">
                                <input type="radio" id="test30" name="radio-group">
                                <label for="test30"></label>
                            </p>
                            <input type="text" class="w-100 site-input" value="Option 4" placeholder="Enter Option 4">
                        </div>
                        <p class="mt-1 black-text mb-0">Note: Select the correct answer</p>
                    </div>
                    <div class="modal-btn-div mt-2">
                        <button type="submit" class="login-btn px-5" data-dismiss="modal" aria-label="Close">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-question modal-icon yellow-back"></i>
                </div>
                <p class="grey-text">Are You Sure You Want To Delete The Question?</p>
                <div class="d-flex align-items-center mt-2 justify-content-center">
                    <button class="login-btn mr-2 px-4" data-toggle="modal" data-target=".questionDeleted" data-dismiss="modal" aria-label="Close">Yes</button>
                    <button class="site-btn px-4" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade questionDeleted" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-check modal-icon"></i>
                </div>
                <p class="grey-text mt-1 pb-5">Question Has Been Deleted</p>
            </div>
        </div>
    </div>
</div>


@endsection
