<?php

use Illuminate\Database\Seeder;
use App\Server;

class DatabaseSeeder extends Seeder
{
  /**
   * Default situation : correct data for developpement session
   * @return void
   */
  public function run()
  {
    $raval = Server::create(['name' => 'Raval', 'slug' => 'raval']);
    $lily = Server::create(['name' => 'Lily', 'slug' => 'lily']);
    $danathor = Server::create(['name' => 'Danathor', 'slug' => 'danathor']);
    $silvosse = Server::create(['name' => 'Silvosse', 'slug' => 'silvosse']);
    $kuri = Server::create(['name' => 'Kuri', 'slug' => 'kuri']);
    $silouate = Server::create(['name' => 'Silouate', 'slug' => 'silouate']);
    $li_crounch = Server::create(['name' => 'Li Crounch', 'slug' => 'li-crounch']);
    $domen = Server::create(['name' => 'Domen', 'slug' => 'domen']);
    $farle = Server::create(['name' => 'Farle', 'slug' => 'farle']);
    $bowisse = Server::create(['name' => 'Bowisse', 'slug' => 'bowisse']);
    $menalt = Server::create(['name' => 'Menalt', 'slug' => 'menalt']);
    $ulette = Server::create(['name' => 'Ulette', 'slug' => 'ulette']);
    $helsephine = Server::create(['name' => 'Helsephine', 'slug' => 'helsephine']);
    $allister = Server::create(['name' => 'Allister', 'slug' => 'allister']);
    $sumens = Server::create(['name' => 'Sumens', 'slug' => 'sumens']);
    $hyrkul = Server::create(['name' => 'Hyrkul', 'slug' => 'hyrkul']);
    $pouchecot = Server::create(['name' => 'Pouchecot', 'slug' => 'pouchecot']);
    $vil_smisse = Server::create(['name' => 'Vil Smisse', 'slug' => 'vil-smisse']);
    $jiva = Server::create(['name' => 'Jiva', 'slug' => 'jiva']);
    $crocoburio = Server::create(['name' => 'Crocoburio', 'slug' => 'crocoburio']);
    $otomai = Server::create(['name' => 'Otomaï', 'slug' => 'otomai']);
    $hel_munster = Server::create(['name' => 'Hel Munster', 'slug' => 'hel-munster']);
    $goultard = Server::create(['name' => 'Goultard', 'slug' => 'goultard']);
    $hecate = Server::create(['name' => 'Hecate', 'slug' => 'hecate']);
    $amayiro = Server::create(['name' => 'Amayiro', 'slug' => 'amayiro']);
    $maimane = Server::create(['name' => 'Maimane', 'slug' => 'maimane']);
    $brumaire = Server::create(['name' => 'Brumaire', 'slug' => 'brumaire']);
    $djaul = Server::create(['name' => 'Djaul', 'slug' => 'djaul']);
    $agride = Server::create(['name' => 'Agride', 'slug' => 'agride']);
    $mylaise = Server::create(['name' => 'Mylaise', 'slug' => 'mylaise']);
    $many = Server::create(['name' => 'Many', 'slug' => 'many']);
    $rykke_errel = Server::create(['name' => 'Rykke-Errel', 'slug' => 'rykke-errel']);

    $this->command->info('Default Seed was done successfully');
  }
}
