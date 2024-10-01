<?php
    include('app/bootstrap.php');

    if(isset($_GET['node']) && isset($_GET['action'])) {
        $node = $_GET['node'];
        $action = $_GET['action'];

        if($node == 'location') {
            if($action == 'getProvince' && isset($_POST['region_id'])) {
                $data = [];
                $provinces = \App\Models\Location\Province::where('region_id', $_POST['region_id'])->get();
                foreach($provinces as $province) {
                    $data[] = ['value' => $province->id, 'text' => $province->name];
                }
                echo json_encode($data);
            }
            else if($action == 'getMunicipality' && isset($_POST['province_id'])) {
                $data = [];
                $municipalities = \App\Models\Location\Municipality::where('province_id', $_POST['province_id'])->get();
                foreach($municipalities as $municipality) {
                    $data[] = ['value' => $municipality->id, 'text' => $municipality->name];
                }
                echo json_encode($data);
            }
            else if($action == 'getBarangay' && isset($_POST['municipality_id'])) {
                $data = [];
                $barangays = \App\Models\Location\Barangay::where('municipality_id', $_POST['municipality_id'])->get();
                foreach($barangays as $barangay) {
                    $data[] = ['value' => $barangay->id, 'text' => $barangay->name];
                }
                echo json_encode($data);
            }
        }



    }
?>