@include('layouts.dashboard.card', [
    'number' => number_format($desludgingVehicleCount, 0),
    'heading' => 'Desludging Vehicles',
    'image' => asset('img/svg/imis-icons/desludgingVehicle.svg'),

])
