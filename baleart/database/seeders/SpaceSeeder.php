<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            
            // Des d'un arxiu JSON
            $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
            $spaces = json_decode($jsonData, true);
    
            // Insertar cada registro en la tabla
            foreach ($spaces as $space) {

                $accessType = $space['accessibilitat'];
                if ($accessType == 'Sí') {
                    $accessType = 'y';
                } elseif ($accessType == 'No') {
                    $accessType = 'n';
                } elseif ($accessType == 'Parcialment accessible')
                    $accessType = 'p';

                Address::create([
                    'nom'     => $space['adreca'],
                    'municipality_id'     => Municipality::where('name', $space['municipi'])->first()->id,
                    'zone_id'     => Zone::where('name', $space['zona'])->first()->id,
                ]);

                Space::create([
                    'name' => $space['nom'],
                    'regNumber' => $space['registre'],
                    'observation_CA' => $space['descripcions/cat'],
                    'observation_ES' => $space['descripcions/esp'],
                    'observation_EN' => $space['descripcions/eng'],
                    'email' => $space['email'],
                    'phone' => $space['telefon'],
                    'website' => $space['web'],
                    'accessType' => $accessType,
                    'totalScore' => 0,
                    'countScore' => 0,
                    'address_id' => Address::where('nom', $space['adreca'])->first()->id,
                    'space_type_id' => SpaceType::where('name', $space['tipus'])->first()->id,
                    'user_id' => User::where('email', $space['gestor'])->first()?
                    User::where('email', $space['gestor'])->first()->id:
                    User::where('email', 'admin@baleart.com')->first()->id,
                ]);                
                
            }
            
            foreach ($spaces as $space) {
                
                $services = explode(',', $space['serveis']);
                foreach ($services as $service) {
                    $serviceModel = Service::where('name', trim($service))->first();
                    if ($serviceModel) {
                        $spaceModel = Space::where('name', $space['nom'])->first();
                        if ($spaceModel) {
                            $spaceModel->services()->attach($serviceModel->id);
                        }
                    }
                }

                $modalities = explode(',', $space['modalitats']);
                foreach ($modalities as $modality) {
                    $modalityModel = Modality::where('name', trim($modality))->first();
                    if ($modalityModel) {
                        $spaceModel = Space::where('name', $space['nom'])->first();
                        if ($spaceModel) {
                            $spaceModel->modalities()->attach($modalityModel->id);
                        }
                    }
                }

            }

        }
    }
}
