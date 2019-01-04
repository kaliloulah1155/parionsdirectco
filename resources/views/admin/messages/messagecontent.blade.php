@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Message</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" >E-MAIL</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('smscontent')}}" style="color:black">Envoi de message</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- editor -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Envoi de mail</h4>
                    <!-- Create the editor container -->
                    <hr/>
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/sendsmscontent') }}" id="formsms" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                            <label class="col-md-3 m-t-15">Destinataires</label>
                            <div class="col-md-9">
                                <select class="form-control m-t-15" name="listgamers_data[]" multiple="multiple" style="height: 100px;width: 50%; ">
                                    <optgroup label="selectionnez un ou plusieurs emails">
                                        @foreach($listgamers_data as $listgamers)
                                            <option value="{{ $listgamers->email }}" >{{ $listgamers->email }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- COMPONENT START -->
                        <div class="form-group">
                            <div class="input-group input-file col-sm-5" >
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Selectionnez</button>
                                </span>
                                <input type="text" name="file" class="form-control" placeholder='Selectionnez un fichier...' />
                                <span class="input-group-btn">
                                     <button class="btn btn-warning btn-reset" type="button">Supprimez</button>
                                </span>
                            </div>
                        </div>
                        <!-- COMPONENT END -->
                        <div class="form-group">
                            <label for="depart" class="col-sm-3 control-label col-form-label" >Titre</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="titre" name="titre" value="{{old('titre')}}" placeholder="Parions direct">
                            </div>
                        </div>
                        <input name="about" type="hidden">
                        <div id="editor" style="height: 300px;">
                            <p>
                            </p>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-dark">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
<script>
function bs_input_file() {
    $(".input-file").before(
        function() {
            if ( ! $(this).prev().hasClass('input-ghost') ) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("name",$(this).attr("name"));
                element.change(function(){
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function(){
                    element.click();
                });
                $(this).find("button.btn-reset").click(function(){
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor","pointer");
                $(this).find('input').mousedown(function() {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}
$(function() {
    bs_input_file();
});
</script>
@endsection