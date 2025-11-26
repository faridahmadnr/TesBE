<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations: create view raw_button_click.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW raw_kur_button_click AS
            SELECT
                e.id AS event_id,
                e.user_id,
                e.event_name,
                
                e.j ->> 'button_marker'         AS button_marker,
                e.j ->> 'button_name'           AS button_name,
                e.j ->> 'previous_page_marker'  AS previous_page_marker,
                e.j ->> 'pre_previous_marker'   AS pre_previous_marker,
                e.j ->> 'entry_source'          AS entry_source,
                e.j ->> 'previous_page_name'    AS previous_page_name,
                e.j ->> 'entry_method'          AS entry_method,
                e.j ->> 'area_page'             AS area_page,

                e.email,
                e.ip_address


            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_button_click'
            ) e;
        ");
    }

    /**
     * Rollback migration: drop view raw_button_click.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS raw_kur_button_click;');
    }
};