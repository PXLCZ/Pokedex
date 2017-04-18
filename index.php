<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokédex</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            function loadPokedex(res,res2){
                console.log(res,res2);
                var html_str = "";
                html_str += "<fieldset>";
                    html_str += "<legend>Pokédex</legend>";
                        html_str += "<div class='box'>";
                            html_str += "<h4>" +  "#" + res.national_id + " " +res.name + "</h4>";
                            if(res.national_id > 99) id = res.national_id;
                            else if(res.national_id > 9) id = "0" + res.national_id; 
                            else id = id = "00" + res.national_id;
                            html_str += "<img src='http://pokemon.realgoodrealfast.com/gen1/" + id + ".gif' />";
                            html_str += "<div class='list'>";
                                html_str += "<h5>Type(s)</h5>";
                                html_str += "<ul class='list-unstyled'>";
                                for(var i = 0; i < res.types.length; i++) {
                                    html_str += "<li class='indent'>" + res.types[i].name + "</li>";
                                }
                                html_str += "</ul>";
                                html_str += "<ul class='list-inline'>"
                                        html_str += "<li>";
                                            html_str += "<h5>Height</h5>";
                                            inch = res.height * 39.3701 / 10;
                                            feet = Math.floor(inch / 12);
                                            inch = Math.round(inch % 12);
                                            if(feet == 0) html_str += "<p class='indent'>" + inch + "&#34</p>";
                                            else html_str += "<p class='indent'>" + feet + "&#39 " + inch + "&#34</p>";
                                        html_str += "</li>";
                                        html_str += "<li>";
                                            html_str += "<h5>Weight</h5>";
                                            weight = Math.round(res.weight * 2.20462 * 10) / 100;
                                            html_str += "<p class='indent'>" + weight + " lb</p>";
                                        html_str += "</li>";
                                html_str += "</ul>";
                                html_str += "</li>"
                                html_str += "<h5>Description</h5>";
                                html_str += "<ul class='list-unstyled'>"; 
                                html_str += "<li class='indent'>" + res2.description + "</li>";
                                html_str += "</ul>";
                            html_str += "</div>";
                        html_str += "</div>";
                    html_str += "</fieldset>";
                    $("#pokedex").html(html_str);
                    $("#pokedexSmall").html(html_str);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
            }
            $('.pokemon').click(function(){
                $.get("http://pokeapi.co/api/v1/pokemon/" + $(this).attr('num') + "/", function(res){
                    $.get("http://pokeapi.co" + res.descriptions[0]['resource_uri'], function(res2){
                        loadPokedex(res,res2); 
                    }, "json");  
                }, "json");
            })
            var message = "";
            message += "<fieldset>";
            message += "<legend>Pokédex</legend>";
            message += "<p class='box'>Welcome to the Pokédex. Click on a Pokémon picture to see some information about it.</p>";
            message += "</fieldset>";
            $("#pokedex").html(message);
            $("#pokedexSmall").html(message);
        })
    </script>
</head>
<body>
    <style>
    .list{
        margin: 20px;
        text-align: left;
    }
    .scrollit{
        float: right;
    }
    .box{
        text-align: center;
        border: gray 1px solid;
        border-radius: 20px;
        margin: 0px 0px 20px 0px auto;
        padding: 10px;
    }
    .indent{
        margin-left: 10px;
    }
    #pokedex{
        background-color: white;
        z-index: 1;
    }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="pokedex" class="col-md-2 scrollspy hidden-xs hidden-sm" data-spy="affix" data-offset-top="50">

            </div>
            <div id="pokedexSmall" class="col-md-2 hidden-md hidden-lg"> 

            </div>
            <div class="col-md-10 scrollit">
                <fieldset>
                    <legend>Pokémon (1-151)</legend>
                    <div class="box">
<?php
for($i=1;$i<=151;$i++)
{?>
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/<?= $i ?>.png" class="pokemon" num="<?= $i ?>" />

<?php
}?>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>
