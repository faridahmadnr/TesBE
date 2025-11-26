<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW raw_kur_confirm_value AS
            SELECT 
                e.id AS event_id,
                e.user_id,
                e.event_name,
                (e.j -> 'params') ->> 'page_marker'           AS page_marker,
                (e.j -> 'params') ->> 'previous_page_marker'  AS previous_page_marker,
                (e.j -> 'params') ->> 'pre_previous_marker'   AS pre_previous_marker,
                (e.j -> 'params') ->> 'page_name'             AS page_name,
                (e.j -> 'params') ->> 'previous_page_name'    AS previous_page_name,
                (e.j -> 'params') ->> 'entry_source'          AS entry_source,
                (e.j -> 'params') ->> 'entry_method'          AS entry_method,
                (e.j -> 'params') ->> 'page_area'             AS page_area,
                (e.j -> 'params') ->> 'value'                 AS value,

                e.email,
                e.ip_address
            FROM (
                SELECT 
                    events.id,
                    events.user_id,
                    events.event_name,
                    email,
                    ip_address,
                    (events.event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE events.event_name = 'kur_confirm_value'
            ) e;
        ");
    }

    public function down()
    {
        DB::unprepared("
            DROP VIEW IF EXISTS raw_kur_confirm_value;
        ");
    }
};