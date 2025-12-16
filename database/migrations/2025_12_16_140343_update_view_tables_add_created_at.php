<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW raw_kur_page_enter AS
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
                e.created_at
            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_page_enter'
            ) e;
        ");
        DB::statement("
            CREATE OR REPLACE VIEW raw_kur_page_slide AS
            SELECT
                e.id AS event_id,
                e.user_id,
                e.event_name,
                
                e.j ->> 'page_marker'          AS page_marker,
                e.j ->> 'previous_page_marker' AS previous_page_marker,
                e.j ->> 'pre_previous_marker'  AS pre_previous_marker,
                e.j ->> 'page_name'            AS page_name,
                e.j ->> 'entry_source'         AS entry_source,
                e.j ->> 'previous_page_name'   AS previous_page_name,
                e.j ->> 'entry_method'         AS entry_method,
                e.j ->> 'area_page'            AS area_page,
                e.j ->> 'radius_top'           AS radius_top,
                e.j ->> 'scroll_radius'        AS scroll_radius,
                e.j ->> 'type_scroll'          AS type_scroll,

                e.email,
                e.ip_address,
                e.created_at

            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_page_slide'
            ) e;
        ");
        DB::statement("
            CREATE OR REPLACE VIEW raw_kur_page_stay AS
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
                (e.j -> 'params') ->> 'area_page'             AS area_page,
                (e.j -> 'params') ->> 'time_stay'             AS time_stay,
                (e.j -> 'params') ->> 'type_quit'             AS type_quit,

                e.email,
                e.ip_address,
                e.created_at

            FROM (
                SELECT 
                    events.id,
                    events.user_id,
                    events.event_name,
                    email,
                    ip_address,
                    created_at,
                    (events.event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE events.event_name = 'kur_page_stay'
            ) e;
        ");
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
                e.ip_address,
                e.created_at


            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_button_click'
            ) e;
        ");
        DB::statement("
            CREATE OR REPLACE VIEW raw_kur_button_show AS
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
                e.ip_address,
                e.created_at

            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_button_show'
            ) e;
        ");
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
                e.ip_address,
                e.created_at
            FROM (
                SELECT 
                    events.id,
                    events.user_id,
                    events.event_name,
                    email,
                    ip_address,
                    created_at,
                    (events.event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE events.event_name = 'kur_confirm_value'
            ) e;
        ");

        DB::unprepared("
            CREATE OR REPLACE VIEW raw_kur_confirm_result AS
            SELECT 
            e.id AS event_id,
            e.user_id,
            e.event_name,

            (e.j -> 'params') ->> 'button_marker'         AS button_marker,
            (e.j -> 'params') ->> 'previous_page_marker'  AS previous_page_marker,
            (e.j -> 'params') ->> 'pre_previous_marker'   AS pre_previous_marker,
            (e.j -> 'params') ->> 'button_name'           AS button_name,
            (e.j -> 'params') ->> 'previous_page_name'    AS previous_page_name,
            (e.j -> 'params') ->> 'entry_source'          AS entry_source,
            (e.j -> 'params') ->> 'entry_method'          AS entry_method,
            (e.j -> 'params') ->> 'page_area'             AS page_area,
            (e.j -> 'params') ->> 'value'                 AS value,
            (e.j -> 'params') ->> 'status'                AS status,

            e.email,
            e.ip_address,
            e.created_at

        FROM (
            SELECT 
                events.id,
                events.user_id,
                events.event_name,
                email,
                ip_address,
                created_at,
                (events.event_properties #>> '{}'::text[])::jsonb AS j
            FROM events
            WHERE events.event_name = 'kur_confirm_result'
        ) e;

        ");

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
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    event_properties,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_page_enter'
            ) e

            LEFT JOIN users u 
                ON e.email = u.email

            LEFT JOIN activity_log a_l
                ON e.email = SPLIT_PART(a_l.description, ' ', 2);
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_page_slide AS
            SELECT
                e.id AS event_id,
                e.user_id,
                e.event_name,

                e.j ->> 'page_marker' AS page_marker,
                e.j ->> 'previous_page_marker' AS previous_page_marker,
                e.j ->> 'pre_previous_marker' AS pre_previous_marker,
                e.j ->> 'page_name' AS page_name,
                e.j ->> 'entry_source' AS entry_source,
                e.j ->> 'previous_page_name' AS previous_page_name,
                e.j ->> 'entry_method' AS entry_method,
                e.j ->> 'area_page' AS area_page,
                e.j ->> 'radius_top' AS radius_top,
                e.j ->> 'scroll_radius' AS scroll_radius,
                e.j ->> 'type_scroll' AS type_scroll,

                e.email,
                e.ip_address,
                

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT 
                    id, user_id, event_name, event_properties, email, ip_address, created_at,
                    (event_properties #>> '{}')::jsonb AS j
                FROM events
                WHERE event_name = 'kur_page_slide'
            ) e

            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_page_stay AS
            SELECT 
                e.id AS event_id,
                e.user_id,
                e.event_name,

                (e.j -> 'params') ->> 'page_marker' AS page_marker,
                (e.j -> 'params') ->> 'previous_page_marker' AS previous_page_marker,
                (e.j -> 'params') ->> 'pre_previous_marker' AS pre_previous_marker,
                (e.j -> 'params') ->> 'page_name' AS page_name,
                (e.j -> 'params') ->> 'previous_page_name' AS previous_page_name,
                (e.j -> 'params') ->> 'entry_source' AS entry_source,
                (e.j -> 'params') ->> 'entry_method' AS entry_method,
                (e.j -> 'params') ->> 'area_page' AS area_page,
                (e.j -> 'params') ->> 'time_stay' AS time_stay,
                (e.j -> 'params') ->> 'type_quit' AS type_quit,

                e.email,
                e.ip_address,
                

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT 
                    id,
                    user_id,
                    event_name,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE event_name = 'kur_page_stay'
            ) e

            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_button_click AS
            SELECT
                e.id AS event_id,
                e.user_id,
                e.event_name,

                e.j ->> 'button_marker' AS button_marker,
                e.j ->> 'button_name' AS button_name,
                e.j ->> 'previous_page_marker' AS previous_page_marker,
                e.j ->> 'pre_previous_marker' AS pre_previous_marker,
                e.j ->> 'entry_source' AS entry_source,
                e.j ->> 'previous_page_name' AS previous_page_name,
                e.j ->> 'entry_method' AS entry_method,
                e.j ->> 'area_page' AS area_page,

                e.email,
                e.ip_address,
                

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE event_name = 'kur_button_click'
            ) e
            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_button_show AS
            SELECT
                e.id AS event_id,
                e.user_id,
                e.event_name,

                e.j ->> 'button_marker' AS button_marker,
                e.j ->> 'button_name' AS button_name,
                e.j ->> 'previous_page_marker' AS previous_page_marker,
                e.j ->> 'pre_previous_marker' AS pre_previous_marker,
                e.j ->> 'entry_source' AS entry_source,
                e.j ->> 'previous_page_name' AS previous_page_name,
                e.j ->> 'entry_method' AS entry_method,
                e.j ->> 'area_page' AS area_page,

                e.email,
                e.ip_address,
                

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT
                    id,
                    user_id,
                    event_name,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE event_name = 'kur_button_show'
            ) e
            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_confirm_value AS
            SELECT 
                e.id AS event_id,
                e.user_id,
                e.event_name,

                (e.j -> 'params') ->> 'page_marker' AS page_marker,
                (e.j -> 'params') ->> 'previous_page_marker' AS previous_page_marker,
                (e.j -> 'params') ->> 'pre_previous_marker' AS pre_previous_marker,
                (e.j -> 'params') ->> 'page_name' AS page_name,
                (e.j -> 'params') ->> 'previous_page_name' AS previous_page_name,
                (e.j -> 'params') ->> 'entry_source' AS entry_source,
                (e.j -> 'params') ->> 'entry_method' AS entry_method,
                (e.j -> 'params') ->> 'page_area' AS page_area,
                (e.j -> 'params') ->> 'value' AS value,

                e.email,
                e.ip_address,
            

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT 
                    id,
                    user_id,
                    event_name,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE event_name = 'kur_confirm_value'
            ) e
            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW enriched_kur_confirm_result AS
            SELECT 
                e.id AS event_id,
                e.user_id,
                e.event_name,

                (e.j -> 'params') ->> 'page_marker' AS page_marker,
                (e.j -> 'params') ->> 'previous_page_marker' AS previous_page_marker,
                (e.j -> 'params') ->> 'pre_previous_marker' AS pre_previous_marker,
                (e.j -> 'params') ->> 'page_name' AS page_name,
                (e.j -> 'params') ->> 'previous_page_name' AS previous_page_name,
                (e.j -> 'params') ->> 'entry_source' AS entry_source,
                (e.j -> 'params') ->> 'entry_method' AS entry_method,
                (e.j -> 'params') ->> 'page_area' AS page_area,
                (e.j -> 'params') ->> 'value' AS value,
                (e.j -> 'params') ->> 'status' AS status,

                e.email,
                e.ip_address,
                

                u.name AS user_name,
                u.email_verified_at,
                u.password,
                u.password_changed_at,
                u.active,
                u.last_login_at,
                u.last_login_ip,
                u.status AS user_status,
                u.remember_token,
                u.created_at AS users_created_at,
                u.updated_at AS users_updated_at,
                u.deleted_at AS users_deleted_at,

                a_l.id AS activity_log_id,
                a_l.log_name,
                a_l.description,
                a_l.subject_type,
                a_l.subject_id,
                a_l.causer_type,
                a_l.causer_id,
                a_l.properties,
                a_l.created_at AS activity_log_created_at,
                a_l.updated_at AS activity_log_updated_at,
                a_l.event,
                a_l.batch_uuid,
                e.created_at

            FROM (
                SELECT 
                    id,
                    user_id,
                    event_name,
                    email,
                    ip_address,
                    created_at,
                    (event_properties #>> '{}'::text[])::jsonb AS j
                FROM events
                WHERE event_name = 'kur_confirm_result'
            ) e
            LEFT JOIN users u ON e.email = u.email
            LEFT JOIN activity_log a_l ON e.email = SPLIT_PART(a_l.description, ' ', 2)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS raw_kur_page_enter;');
        DB::statement('DROP VIEW IF EXISTS raw_kur_page_slide;');
        DB::statement('DROP VIEW IF EXISTS raw_kur_page_stay;');
        DB::statement('DROP VIEW IF EXISTS raw_kur_button_click;');
        DB::statement('DROP VIEW IF EXISTS raw_kur_button_show;');
        DB::unprepared("DROP VIEW IF EXISTS raw_kur_confirm_value;");
        DB::unprepared("DROP VIEW IF EXISTS raw_confirm_result;");
        DB::statement('DROP VIEW IF EXISTS enriched_kur_page_enter;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_page_slide;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_page_stay;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_button_click;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_button_show;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_confirm_value;');
        DB::statement('DROP VIEW IF EXISTS enriched_kur_confirm_result;');
    }
};
