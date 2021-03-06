<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div style="width: 900px;" class="container max-w-full mx-auto pt-4">
        <div>
            <a style="float:right; display:inline-block;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <h1 class="text-center text-4xl font-bold mb-4">Calories Calculator</h1>
        <a href="/exercises" class="bg-gray-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Back</a>
        <div class="mb-4">
            <form method="POST" onsubmit="return false;">
                @method('PUT')
                @csrf
                <?php
                //echo json_encode($exercises);
                $nameArray = array();
                $caloriesArray = array();
                ?>
                @foreach($exercises as $exercise)
                <div class="mb-2">
                    <a href="/exercises/{{ $exercise->id }}/details" class="text-xl font-bold text-blue-500">{{ $exercise->title }}</a>
                    <input type="number" name="value{{ $exercise->title}}" id="value{{ $exercise->title}}" class="float-right appearance-none bg-transparent border-none text-red-700 leading-tight focus:outline-none" value="0" min="0">
                    <?php
                        array_push($nameArray, $exercise->title);
                        array_push($caloriesArray, $exercise->calories);

                    ?>
                    <p class="pb-3 text-md text-gray-600">Calories burned in a minute: <span class="text-red-200">{{ $exercise->calories}}</span></p>


                    <hr class="mt-3">
                </div>
                @endforeach

                <input type="submit" value="Calculate Total Calories" onclick='calcSum(<?php echo json_encode($nameArray) ?>,<?php echo json_encode($caloriesArray) ?>);' id='calculate' class="bg-green-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">
                <span class="float-right" id="total"></span>
            </form>
        </div>
    </div>
    <script>
        function calcSum(names,calories) {
            let sum = 0;
            let sumHour = 0;
            for(i = 0; i < names.length; i++){
                //console.log("value" + names[i])
                //console.log(document.getElementById("value" + names[i]).value);
                sum += document.getElementById("value" + names[i]).value * calories[i];
                sumHour += parseInt(document.getElementById("value" + names[i]).value);
            }
            document.getElementById('total').innerHTML = sum + " calories burned over " + sumHour + " minutes" ;
        }
    </script>
</body>

</html>