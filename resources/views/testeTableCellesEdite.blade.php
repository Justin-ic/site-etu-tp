

<!-- 

Ce code est adapté aux tableaux déjà remplie et on souhait les modiffier
dans mon cas, par défaut, il n'y a pas de note. ainsi, je ne peut pas faire un update
 -->
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Table Inline Edit Using JQuery Editable - NiceSnippest.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('styles/tableCellesEdit/bootstrapv3.4.1.min.css') }}">
    <script src="{{ asset('styles/tableCellesEdit/jquery3.5.1.min.js') }}"></script>
    <link href="{{ asset('styles/tableCellesEdit/jquery1.5.0-editable.css') }}" rel="stylesheet" />
    <link href="{{ asset('styles/tableCellesEdit/toastr.css') }}" rel="stylesheet" />
    <script src="{{ asset('styles/tableCellesEdit/jquery-editable-poshytip.min.js') }}"></script>
    <script src="{{ asset('styles/tableCellesEdit/toastr.min.js') }}"></script>


    <!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
</head>
<style type="text/css">
    .container h2 , .panel-info{
        margin-top:80px;
        line-height:50px;
    }

    th, td{
      text-align: center;
    }
</style> 
<body>
    <div class="container-fluid">
        <div class="col-md-12">
        <h2 class="text-center">Laravel 9 Table Inline Edit Using JQuery Editable - NiceSnippest.com</h2>
        <div class="panel panel-info">
            <div class="panel-heading">Laravel 9 Table Inline Edit Using jQuery editable</div>
            <div class="panel-body">
            



            <div class=" table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr class="MCenter">
                            <th>No</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>NCE</th>
                            <th>Note1</th>
                            <th>Note2</th>
                            <th>Note3</th>
                            <th>Note4</th>
                            <th>Note5</th>
                            <th>Note6</th>
                            <th>Note7</th>
                            <th>Note8</th>
                            <th>Note9</th>
                            <th>Note10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- @ foreach($product as $product) -->
                        <?php $cpt=1; ?>
                        @foreach($ListeEtuInscrit as $LigneInsscrit)
                        <!-- @ dd($LigneInsscrit->etudiant->Nom); -->
                            <tr>
                                <td><?=$cpt++?></td>
                                <td>
                                    <a href="" class="update" data-name="name" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter name">{{$LigneInsscrit->etudiant->Nom}}</a>
                                    <!-- <a href="" class="update" data-name="name" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter name">OUATTARA</a> -->
                                </td>
                                <td>
                                    <a href="" class="update" data-name="detail" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter Detail">{{$LigneInsscrit->etudiant->Prenom}}</a>
                                </td>

                                <td>
                                    <a href="" class="update" data-name="detail" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter Detail">{{$LigneInsscrit->etudiant->NCE}}</a>
                                </td>

                                <!-- @ foreach($LigneInsscrit->notes as $LaNote) -->

                                <?php for ($i=0; $i < $LigneInsscrit->notes->count(); $i++) { ?>
                                  <td class="MCenter">
                                     <a href="" class="update" data-name="detail" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter Detail">{{$LigneInsscrit->notes[$i]->Note}}</a>
                                  </td>
                                <?php } ?>

                                <?php for ($i=$LigneInsscrit->notes->count(); $i < 10; $i++) { ?>
                                  <td class="MCenter">
                                     <a href="" class="update" data-name="detail" data-type="text" data-pk="{x{ $product->id }}" data-title="Enter Detail"></a>
                                  </td>
                                <?php } ?>

                                <td>
                                    <a class="deleteProduct btn btn-xs btn-danger" data-id="{x{ $product->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- @ endforeach -->
                    </tbody>
                </table>
            </div>
            </div>



            
        </div>
        </div>
    </div>


    <script type="text/javascript">
        $.fn.editable.defaults.mode = 'inline';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.update').editable({
            url: "{x{ route('product.update') }}",
            type: 'text',
            pk: 1,
            name: 'name',
            title: 'Enter name'
        });

        $(".deleteProduct").click(function(){
            $(this).parents('tr').hide();
            var id = $(this).data("id");
            var token = '{{ csrf_token() }}';
            $.ajax(
            {
                method:'POST',
                url: "product/delete/"+id,
                data: {_token: token},
                success: function(data)
                {
                    toastr.success('Successfully!','Delete');
                }
            });
        });
    </script>
</body>
</html>
