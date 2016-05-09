<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Server;
use App\Guild;
use App\Alliance;
use App\GuildMember;

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

    // User Nolan
    $nolan = User::create([
      'username' => 'seezer13',
      'email' => 'seezer13@gmail.com',
      'password' => Hash::make('secret'),
      'firstname' => 'Nolan',
      'lastname' => 'Rigo',
      'remember_token' => str_random(40),
      'birthday' => '1994-03-13',
      'remember_token' => str_random(40),
      'valid' => true
    ]);
    $nolan->preferenced_server()->associate($menalt)->save();

    // User Kevin
    $kevin = User::create([
      'username' => 'kevin',
      'email' => 'kevin@hotmail.com',
      'password' => Hash::make('secret'),
      'birthday' => '1998-01-05',
      'remember_token' => str_random(40),
      'valid' => false
    ]);
    $kevin->preferenced_server()->associate($jiva)->save();

    // User Marco
    $marco = User::create([
      'username' => 'marcolecalme',
      'email' => 'marco.visalli@cpnv.ch',
      'password' => Hash::make('secret'),
      'firstname' => 'Marco',
      'lastname' => 'Visalli',
      'birthday' => '1994-08-08',
      'remember_token' => str_random(40),
      'valid' => true
    ]);
    $marco->preferenced_server()->associate($mylaise)->save();

    // User Jonathan
    $jo = User::create([
      'username' => 'jzaehrin',
      'email' => 'jonathan.zaehringer@cpnv.ch',
      'password' => Hash::make('secret'),
      'firstname' => 'Jonathan',
      'lastname' => 'Zaehringer',
      'birthday' => '1994-11-15',
      'remember_token' => str_random(40),
      'valid' => true
    ]);
    $jo->preferenced_server()->associate($sumens)->save();

    // User Seb
    $seb = User::create([
      'username' => 'enormeetsec',
      'email' => 'sebastien.martin@cpnv.ch',
      'password' => Hash::make('secret'),
      'firstname' => 'Sébastien',
      'lastname' => 'Martin',
      'birthday' => '1992-09-01',
      'remember_token' => str_random(40),
      'valid' => false
    ]);
    $seb->preferenced_server()->associate($mylaise)->save();

    // Alliance
    $alliancesolo = New Alliance;
    $alliancesolo->name = 'Alliance Solo';
    $alliancesolo->icon_path = 'yo';
    $alliancesolo->save();

    // L'épée D'Ophil
    $lepeedophil = new Guild;
    $lepeedophil->name = 'L\'épée D\'Ophile';
    $lepeedophil->server()->associate($sumens);
    $lepeedophil->alliance()->associate($alliancesolo);
    $lepeedophil->save();

    // Dynastie Verte
    $dynastieverte = new Guild;
    $dynastieverte->name = 'La Dynastie Verte';
    $dynastieverte->server()->associate($mylaise);
    $dynastieverte->save();

    // Les Chevaliers D'Émeraude
    $chevalierdemeraude = new Guild;
    $chevalierdemeraude->name = 'Les Chevaliers D\'Émeraude';
    $chevalierdemeraude->server()->associate($menalt);
    $chevalierdemeraude->save();

    $jo->guild_members()->create(['guild_id' => $lepeedophil->id, 'role' => 'master']);



    $this->command->info('Seed was done successfully');
  }
}
