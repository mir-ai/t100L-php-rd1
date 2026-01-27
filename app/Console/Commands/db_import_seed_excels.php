<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ControllerSupports\CityCs;
use App\ControllerSupports\AlertCs;
use App\ControllerSupports\ClientCs;
use App\ControllerSupports\AreaCityCs;
use App\ControllerSupports\JmaAreaCodeCs;
use App\ControllerSupports\SubscriptionCs;
use App\ControllerSupports\CityWeather27AlertCs;

class db_import_seed_excels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import_seed_excels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import seed excel files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // storage/initdata/警報_initdata.xlsx を読み込んで初期化する
        $this->importSeedAlert();

        // storage/initdata/受信者_initdata.xlsx を読み込んで初期化する
        $this->importSeedClient();

        // storage/initdata/購読_initdata.xlsx を読み込んで初期化する
        $this->importSeedSubscription();

        // storage/initdata/市区町村_initdata.xlsx を読み込んで初期化する
        $this->importSeedCity();

        // storage/initdata/JMA地域階層_initdata.xlsx を読み込んで初期化する
        $this->importSeedJmaAreaCode();
        
        // storage/initdata/地域階層と市区町村連携_initdata.xlsx を読み込んで初期化する
        $this->importSeedAreaCity();
        
        // storage/initdata/市区町村の気象警報(H27)_initdata.xlsx を読み込んで初期化する
        $this->importSeedCityWeather27Alert();
    }

    // storage/initdata/警報_initdata.xlsx を読み込んで初期化する
    private function importSeedAlert()
    {
        $this->output->info("importing alerts");
        $cs = new AlertCs();
        $cs->importSeeder();
    }

    // storage/initdata/受信者_initdata.xlsx を読み込んで初期化する
    private function importSeedClient()
    {
        $this->output->info("importing clients");
        $cs = new ClientCs();
        $cs->importSeeder();
    }

    // storage/initdata/購読_initdata.xlsx を読み込んで初期化する
    private function importSeedSubscription()
    {
        $this->output->info("importing subscriptions");
        $cs = new SubscriptionCs();
        $cs->importSeeder();
    }

    // storage/initdata/市区町村_initdata.xlsx を読み込んで初期化する
    private function importSeedCity()
    {
        $this->output->info("importing cities");
        $cs = new CityCs();
        $cs->importSeeder();
    }

    // storage/initdata/JMA地域階層_initdata.xlsx を読み込んで初期化する
    private function importSeedJmaAreaCode()
    {
        $this->output->info("importing jma_area_codes");
        $cs = new JmaAreaCodeCs();
        $cs->importSeeder();
    }

    // storage/initdata/地域階層と市区町村連携_initdata.xlsx を読み込んで初期化する
    private function importSeedAreaCity()
    {
        $this->output->info("importing area_cities");
        $cs = new AreaCityCs();
        $cs->importSeeder();
    }

    // storage/initdata/市区町村の気象警報(H27)_initdata.xlsx を読み込んで初期化する
    private function importSeedCityWeather27Alert()
    {
        $this->output->info("importing city_weather27_alerts");
        $cs = new CityWeather27AlertCs();
        $cs->importSeeder();
    }
}
