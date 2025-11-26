<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_page_enter AS
            SELECT
            
                e.id AS event_id,
                e.user_id,
                e.event_name,

                e.j ->> 'previous_page_name'        AS previous_page_name,
                e.j ->> 'previous_page_marker'      AS previous_page_marker,
                e.j ->> 'pre_previous_page_name'    AS pre_previous_page_name,
                e.j ->> 'pre_previous_page_marker'  AS pre_previous_page_marker,
                e.j ->> 'entry_method'              AS entry_method,
                e.j ->> 'area_page'                 AS area_page,
                e.j ->> 'entry_source'              AS entry_source,
                e.j ->> 'page_name'                 AS page_name,
                e.j ->> 'page_marker'               AS page_marker,

                e.email,
                e.ip_address,

                u.name                                AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status                               AS user_status,
                u.remember_token,
                u.created_at                           AS users_created_at,
                u.updated_at                           AS users_updated_at,
                u.deleted_at                           AS users_deleted_at,

                a_l.id                                 AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at                         AS activity_log_created_at,
                a_l.updated_at                         AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid

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
                WHERE event_name = 'kur_page_enter'
            ) e

            LEFT JOIN users u 
                ON e.email = u.email

            LEFT JOIN activity_log a_l
                ON e.email = SPLIT_PART(a_l.description, ' ', 2);
        ");
    }

    /**
     * Rollback migration
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS enriched_kur_page_enter;');
    }
};
