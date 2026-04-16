<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * テーブル events にサンプルデータが入っています。
 *
 * アプリ Sqlace でみたい場合は、 データベース _t100_php_quiz1 > テーブル events
 *
 * MariaDB [_t100_php_quiz1]> desc events;
 *
 *  +-------------+------------------+------+-----+-------------------------+
 *  | Field       | Type             | Null | Key | Default                 |
 *  +-------------+------------------+------+-----+-------------------------+
 *  | id              | int(10) unsigned | NO   | PRI | NULL                |
 *  | pref_code       | int(11)          | YES  |     | NULL                |
 *  | record_id       | varchar(16)      | NO   |     | NULL                |
 *  | pref_name       | varchar(8)       | YES  |     | NULL                |
 *  | city_name       | varchar(12)      | YES  |     | NULL                |
 *  | event_name      | varchar(255)     | NO   | MUL | NULL                |
 *  | event_kana      | varchar(255)     | YES  |     | NULL                |
 *  | event_en        | varchar(255)     | YES  |     | NULL                |
 *  | start_date      | date             | YES  |     | NULL                |
 *  | end_date        | date             | YES  |     | NULL                |
 *  | start_time      | varchar(8)       | YES  |     | NULL                |
 *  | end_time        | varchar(8)       | YES  |     | NULL                |
 *  | start_memo      | text             | YES  |     | NULL                |
 *  | description     | text             | YES  |     | NULL                |
 *  | fee_basic       | varchar(20)      | YES  |     | NULL                |
 *  | fee_detail      | text             | YES  |     | NULL                |
 *  | contact_name    | text             | YES  |     | NULL                |
 *  | contact_tel     | varchar(64)      | YES  |     | NULL                |
 *  | contact_tel_ext | varchar(20)      | YES  |     | NULL                |
 *  | organizer       | varchar(64)      | YES  |     | NULL                |
 *  | location_name   | varchar(128)     | YES  |     | NULL                |
 *  | address         | varchar(128)     | YES  |     | NULL                |
 *  | address2        | varchar(32)      | YES  |     | NULL                |
 *  | lat             | varchar(14)      | YES  |     | NULL                |
 *  | lng             | varchar(14)      | YES  |     | NULL                |
 *  | access          | text             | YES  |     | NULL                |
 *  | parking         | varchar(60)      | YES  |     | NULL                |
 *  | capacity        | text             | YES  |     | NULL                |
 *  | entry_due_date  | varchar(10)      | YES  |     | NULL                |
 *  | entry_due_time  | varchar(32)      | YES  |     | NULL                |
 *  | entry_method    | text             | YES  |     | NULL                |
 *  | entry_url       | text             | YES  |     | NULL                |
 *  | memo            | text             | YES  |     | NULL                |
 *  | category        | varchar(12)      | YES  |     | NULL                |
 *  | ward_name       | varchar(12)      | YES  |     | NULL                |
 *  | open_date       | date             | YES  |     | NULL                |
 *  | update_date     | date             | YES  |     | NULL                |
 *  | is_childcare    | varchar(4)       | YES  |     | NULL                |
 *  | location_no     | varchar(16)      | YES  |     | NULL                |
 *  | created_at      | datetime         | NO   |     | current_timestamp() |
 *  | updated_at      | datetime         | NO   |     | current_timestamp() |
 *  | deleted_at      | datetime         | YES  |     | NULL                |
 *  +-------------+------------------+------+-----+-------------------------+
 *
 */
class F503SqlRawEventTest extends TestCase
{
    // 浜松市で一番イベントが開催されている場所(location_name)を上位3件抽出する
    public function test_503_010_popular_places(): void
    {
        $rows = [];

        // QUIZ
		$expected = null;
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->location_name] = $row->cnt;
        }

        $expected = [
            '浜松こども館' => 96,
            '浜松市男女共同参画・文化芸術活動推進センター（あいホール）' => 93,
            'クリエート浜松' => 54,
        ];

        $this->assertSame($expected, $actual);

    }

    // 区ごと(中央区,浜名区,天竜区)(ward)のイベントの開催件数を求める
    public function test_503_020_event_count_by_wards()
    {
        $rows = [];

        // QUIZ
		$expected = null;
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->ward_name] = $row->cnt;
        }

        $expected = [
            '中央区' => 1321,
            '浜名区' => 416,
            '天竜区' => 101,
        ];

        $this->assertSame($expected, $actual);
    }

    // 開始日毎(open_date)のイベントの上位3件の開催件数を求める
    public function test_503_030_event_count_by_date()
    {
        $rows = [];

        // QUIZ
		$expected = null;
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->ymd] = $row->cnt;
        }

        $expected = [
            '2026年01月19日' => 608,
            '2025年10月21日' => 369,
            '2025年12月12日' => 344,
        ];

        $this->assertSame($expected, $actual);
    }

    // イベント名に浜松が含まれるイベント名(event_name)をイベント名順にすべて抽出する（浜松、ハママツ、はままつ、HAMAMATSU,Hamamatsu,hamamatu）
    public function test_503_050_filter_hamamatsu_event_names()
    {
        $rows = [];

        // QUIZ
		$expected = null;
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[] = $row->event_name;
        }

        $expected = [
            '【イベント】新規受講生募集!!　浜松市地域スポーツ指導者養成講習会',
            'HAMAMATSU JUNIOR CHORUS FESTIVAL 2026',
            'いっしょにあそぼ！ねんね・ごろんの赤ちゃんと＆〈命のバトン浜松〉',
            'いにしえのお屋敷で浜松のお茶体験',
            'いにしえのお屋敷で浜松のお茶体験',
            'いにしえのお屋敷で浜松のお茶体験',
            'サポステはままつの見学、利用体験会(無料)',
            'ジュニアオーケストラ浜松　団員臨時募集',
            'ジュニアオーケストラ浜松・ジュニアクワイア浜松スプリングコンサート2026',
            'ジュニアクワイア浜松　団員臨時募集',
             'はままつジェンダーラボ+(プラス)～ジェンダー視点なソーシャルビジネス基礎講座～(全5回連続講座)託児無料',
             'はままつジェンダーラボ+(プラス)～ジェンダー視点なソーシャルビジネス基礎講座～(全5回連続講座)託児無料',
             'はままつジェンダーラボ+(プラス)～ジェンダー視点なソーシャルビジネス基礎講座～(全5回連続講座)託児無料',
             'はままつジェンダーラボ+(プラス)～ジェンダー視点なソーシャルビジネス基礎講座～(全5回連続講座)託児無料',
             'はままつジェンダーラボ+(プラス)～ジェンダー視点なソーシャルビジネス基礎講座～(全5回連続講座)託児無料',
             'はままつ北フェス2026',
             'はままつ餃子づくり婚活',
             '令和7年度 賀茂真淵記念館　「冬期講座」冬2講座　浜松の谷々に降り立った民俗芸能の今　～手付かずの芸能の魅力を語る～',
             '令和7年度 賀茂真淵記念館　「冬期講座」冬4講座　幕府の裁判史料で読み解く～浜松塩町と村々の訴訟～',
             '令和7年度浜松市医療奨励賞受賞者',
             '令和7年度浜松市社会福祉功績者の表彰',
             '令和8年度浜松市食品衛生監視指導計画(案)の意見募集',
             '令和9年度採用(令和8年度実施)浜松市立小・中学校教員採用選考試験　出願サポートガイダンス',
             '企画展「はままつの文化財　20年のあゆみ」',
             '企画展「古代のはままつと須恵器」',
             '浜松いのちの電話　電話相談員養成講座',
             '浜松オート　ナイター場外発売(山陽)',
             '浜松オート　場外発売(伊勢崎)',
             '浜松オート　場外発売(伊勢崎)',
             '浜松オート　場外発売(山陽　GⅠスピード王決定戦)',
             '浜松オート第12回2節　第16回浜松観光食堂杯フードアタック',
             '浜松オート第14回1節　オッズパークpresents SG第39回全日本選抜オートレース',
             '浜松オート第15回1節　AutoRace.JP投票杯　オトもっちカップ浜松アーリーレース',
             '浜松サイエンスショーフェスティバル',
             '浜松ジュニアジャズオーケストラ Swing Kids成果発表会',
             '浜松医療センター第43回市民公開講座「よくわかる！出張 糖尿病教室」',
             '浜松吹奏楽大会2026 プロムナードコンサート',
             '浜松吹奏楽大会2026 第14回全国中学生交流コンサート',
             '浜松吹奏楽大会2026 第38回全日本高等学校選抜吹奏楽大会',
             '浜松市　こども園・幼稚園・保育園のお仕事フェア',
             '浜松市アクトシティ音楽院　合唱セミナー',
             '浜松市がん患者就労支援講演会(オンライン)',
             '浜松市こども姫様道中',
             '浜松市スポーツ推進委員の募集',
             '浜松市ひきこもり地域支援センターサテライト ゆるりと浜名 家族茶話会',
             '浜松市ひきこもり地域支援センターサテライト ゆるりと浜名 家族茶話会',
             '浜松市ひきこもり地域支援センターサテライト ゆるりと浜名 家族茶話会',
             '浜松市ひきこもり地域支援センターサテライト ゆるりと浜名 家族茶話会',
             '浜松市ひきこもり地域支援センターサテライト ゆるりと浜名 家族茶話会プラス 動画講座「発達障害の理解(1)(2)」',
             '浜松市やらまいか大使本多厚美とともに歌おう世界のLove Songs',
             '浜松市中心市街地活性化ビジョン(案)の意見募集結果の公表について',
             '浜松市動物園ボランティア募集説明会の開催案内',
             '浜松市動物園春の写生大会',
             '浜松市動物園春の写生大会',
             '浜松市動物園春の写生大会',
             '浜松市動物園春の写生大会',
             '浜松市動物園特別企画「動物と自然とわたしたち展」',
             '浜松市土地利用方針(案)の意見募集結果の公表について',
             '浜松市地球温暖化対策実行計画(区域施策編)[2026](案)の意見募集結果の公表について',
             '浜松市姫様道中',
             '浜松市役所採用試験事前説明会＆職種別お仕事紹介',
             '浜松市消防音楽隊第29回定期演奏会',
             '浜松市火災予防条例の一部改正(案)',
             '浜松市生涯学習推進大綱(案)の意見募集結果の公表について',
             '浜松市読書推進講演会',
             '浜松市防災都市づくり計画(案)の意見募集結果の公表について',
             '浜松文芸館出張講座「おくのほそ道」第六期(全6回)',
             '浜松版生活日本語コース(さくらクラス)プロジェクトワーク発表会',
             '特別収蔵展 浜松ゆかりの歌人たち～賀茂真淵、柳本城西、山田震太郎、村木道彦～',
             '第13回はままつフラワーパーク感動フォトコンテスト作品募集',
             '第16回はままつグローバルフェア',
             '第22回浜松シティマラソン開催による交通規制',
             '第48回浜松市社会福祉大会　第2部講演会',
             '第71回浜松市芸術祭はままつ演劇フェスティバル2025 「高校演劇選抜公演」',
             '第73回浜松市市展',
             '農福連携全国フォーラム2025inはままつ',
        ];

        $this->assertSame($expected, $actual);

    }
}
