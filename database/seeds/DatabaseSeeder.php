<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Server;
use App\Guild;
use App\Alliance;
use App\Group;

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
      'remember_token' => User::generate_token(),
      'birthday' => '1994-03-13',
      'valid' => true
    ]);
    $nolan->preferenced_server()->associate($menalt)->save();

    // User Kevin
    $kevin = User::create([
      'username' => 'kevin',
      'email' => 'kevin@hotmail.com',
      'password' => Hash::make('secret'),
      'birthday' => '1998-01-05',
      'remember_token' => User::generate_token(),
      'valid' => true

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
      'remember_token' => User::generate_token(),
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
      'remember_token' => User::generate_token(),
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
      'remember_token' => User::generate_token(),
      'valid' => true
    ]);
    $seb->preferenced_server()->associate($mylaise)->save();

    // User Seb
    $manu = User::create([
      'username' => 'Barchich',
      'email' => 'emmanuel.barchichat@cpnv.ch',
      'password' => Hash::make('secret'),
      'firstname' => 'Emmanuel',
      'lastname' => 'Barchichat',
      'birthday' => '1993-04-25',
      'remember_token' => User::generate_token(),
      'valid' => true
    ]);
    $manu->preferenced_server()->associate($sumens)->save();

    // Alliance
    $alliancesolo = New Alliance;
    $alliancesolo->name = 'Alliance Solo';
    $alliancesolo->icon_path = 'yo';
    $alliancesolo->save();

    // L'épée D'Ophil
    $lepeedophil = new Guild;
    $lepeedophil->name = 'L\'épée D\'Ophile';
    $lepeedophil->icon_path = 'http://img.xooimage.com/files110/3/6/4/dofusicon5-4d259bb.png';
    $lepeedophil->server()->associate($sumens);
    $lepeedophil->alliance()->associate($alliancesolo);
    $lepeedophil->alliance_role = "master";
    $lepeedophil->save();

    // Dynastie Verte
    $dynastieverte = new Guild;
    $dynastieverte->name = 'La Dynastie Verte';
    $dynastieverte->icon_path = 'http://nesparr.e.n.f.unblog.fr/files/2010/11/icondofus31.png';
    $dynastieverte->server()->associate($mylaise);
    $dynastieverte->alliance_role = "master";
    $dynastieverte->save();

    // Les Chevaliers D'Émeraude
    $chevalierdemeraude = new Guild;
    $chevalierdemeraude->name = 'Les Chevaliers D\'Émeraude';
    $chevalierdemeraude->icon_path = 'http://nesparr.e.n.f.unblog.fr/files/2010/11/dofusicone9.png';
    $chevalierdemeraude->server()->associate($menalt);
    $chevalierdemeraude->alliance_role = "master";
    $chevalierdemeraude->save();

    $manu->guild_members()->create(['guild_id' => $lepeedophil->id, 'role' => 'officer']);
    $jo->guild_members()->create(['guild_id' => $lepeedophil->id, 'role' => 'master']);

    $overflew = Group::create([
      'name' => 'Overflew'
    ]);
    $obsidian = Group::create([
      'name' => 'Obsidiant'
    ]);

    $jo->group_members()->create(['group_id' => $overflew->id, 'role' => 'member']);

    // Calendars
    $calendar = [
      'alliancesolo' => $alliancesolo->calendars()->create(['name' => 'Calendrier des Solitaires']),
      'lepeedophil' => $lepeedophil->calendars()->create(['name' => 'Calendrier des épées fortes']),
      'chevalierdemeraude' => $chevalierdemeraude->calendars()->create(['name' => 'Protégons les Émeries']),
      'overflew' => $overflew->calendars()->create(['name' => 'ToA en guilde, chaque samedi']),
      'obsidian' => $obsidian->calendars()->create(['name' => 'Roster McM 50 joueurs, adhésion libre']),
    ];

    $calendar['alliancesolo']->events()->create([
      'name' => 'Raid : Gardien de la Vallée',
      'description' => 'Allez on se tombe gardien de la vallée, on vous donne la compo en vocal',
      'start' => new DateTime('now'),
      'end' => (new DateTime('now'))->modify('+2 hours')
    ]);
    $calendar['alliancesolo']->events()->create([
      'name' => 'Event de guilde en Alliance',
      'description' => 'Event de guilde, PvE / PvP et WvW si des gens sont motivés',
      'start' => (new DateTime('now'))->modify('-1 day +3 hours'),
      'end' => (new DateTime('now'))->modify('-1 day +6 hours +30 minutes')
    ]);

    $this->command->info('Seed was done successfully');
  }
}
