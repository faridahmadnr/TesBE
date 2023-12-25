<?php

namespace Modules\User\Enums;

enum PermissionsEnum: string
{
    case SHOW_DASHBOARD = 'show-dashboard';

    /**
     * Bank Permissions
     */
    case CREATE_BANK = 'create-bank';
    case READ_BANK = 'read-bank';
    case UPDATE_BANK = 'update-bank';
    case DELETE_BANK = 'delete-bank';

    /**
     * Location Permissions
     */
    case CREATE_LOCATION = 'create-location';
    case READ_LOCATION = 'read-location';
    case UPDATE_LOCATION = 'update-location';
    case DELETE_LOCATION = 'delete-location';

    /**
     * Business Permit Permissions
     */
    case CREATE_BUSINESS_PERMIT = 'create-business-permit';
    case READ_BUSINESS_PERMIT = 'read-business-permit';
    case UPDATE_BUSINESS_PERMIT = 'update-business-permit';
    case DELETE_BUSINESS_PERMIT = 'delete-business-permit';

    /**
     * Business Type Permissions
     */
    case CREATE_BUSINESS_TYPE = 'create-business-type';
    case READ_BUSINESS_TYPE = 'read-business-type';
    case UPDATE_BUSINESS_TYPE = 'update-business-type';
    case DELETE_BUSINESS_TYPE = 'delete-business-type';

    /**
     * Credit Term Permissions
     */
    case CREATE_CREDIT_TERM = 'create-credit-term';
    case READ_CREDIT_TERM = 'read-credit-term';
    case UPDATE_CREDIT_TERM = 'update-credit-term';
    case DELETE_CREDIT_TERM = 'delete-credit-term';

    /**
     * User Permissions
     */
    case CREATE_USER = 'create-user';
    case READ_USER = 'read-user';
    case UPDATE_USER = 'update-user';
    case UPDATE_PROFILE = 'update-profile';
    case DELETE_USER = 'delete-user';

    case CREATE_MEMBER = 'create-member';
    case READ_MEMBER = 'read-member';
    case UPDATE_MEMBER = 'update-member';
    case DELETE_MEMBER = 'delete-member';

    /**
     * News Permissions
     */
    case CREATE_NEWS = 'create-news';
    case READ_NEWS = 'read-news';
    case UPDATE_NEWS = 'update-news';
    case DELETE_NEWS = 'delete-news';

    /**
     * News Category Permissions
     */
    case CREATE_NEWS_CATEGORY = 'create-news-category';
    case READ_NEWS_CATEGORY = 'read-news-category';
    case UPDATE_NEWS_CATEGORY = 'update-news-category';
    case DELETE_NEWS_CATEGORY = 'delete-news-category';

    /**
     * FAQ Permissions
     */
    case CREATE_FAQ = 'create-faq';
    case READ_FAQ = 'read-faq';
    case UPDATE_FAQ = 'update-faq';
    case DELETE_FAQ = 'delete-faq';

    /**
     * Credit Request Requirement Permissions
     */
    case CREATE_CREDIT_REQUEST_REQUIREMENT = 'create-credit-request-requirement';
    case READ_CREDIT_REQUEST_REQUIREMENT = 'read-credit-request-requirement';
    case UPDATE_CREDIT_REQUEST_REQUIREMENT = 'update-credit-request-requirement';
    case DELETE_CREDIT_REQUEST_REQUIREMENT = 'delete-credit-request-requirement';

    /**
     * Testimonial Permissions
     */
    case CREATE_TESTIMONI = 'create-testimoni';
    case READ_TESTIMONI = 'read-testimoni';
    case UPDATE_TESTIMONI = 'update-testimoni';
    case DELETE_TESTIMONI = 'delete-testimoni';

    /**
     * Credit Request Type Permissions
     */
    case CREATE_CREDIT_REQUEST_TYPE = 'create-credit-request-type';
    case READ_CREDIT_REQUEST_TYPE = 'read-credit-request-type';
    case UPDATE_CREDIT_REQUEST_TYPE = 'update-credit-request-type';
    case DELETE_CREDIT_REQUEST_TYPE = 'delete-credit-request-type';

    /**
     * Credit Request Permissions
     */
    case CREATE_CREDIT_REQUEST = 'create-credit-request';
    case READ_CREDIT_REQUEST = 'read-credit-request';
    case READ_OWN_CREDIT_REQUEST = 'read-own-credit-request';
    case UPDATE_CREDIT_REQUEST = 'update-credit-request';
    case DELETE_CREDIT_REQUEST = 'delete-credit-request';
    case CONFIRM_CREDIT_REQUEST = 'confirm-credit-request';
    case APPROVE_CREDIT_REQUEST = 'approve-credit-request';
    case REJECT_CREDIT_REQUEST = 'reject-credit-request';

    public function label(): string
    {
        return match ($this) {
            self::SHOW_DASHBOARD => 'Dashboard',
            self::CREATE_BANK => 'Create Bank',
            self::READ_BANK => 'Read Bank',
            self::UPDATE_BANK => 'Update Bank',
            self::DELETE_BANK => 'Delete Bank',
            self::CREATE_BUSINESS_PERMIT => 'Create Business Permit',
            self::READ_BUSINESS_PERMIT => 'Read Business Permit',
            self::UPDATE_BUSINESS_PERMIT => 'Update Business Permit',
            self::DELETE_BUSINESS_PERMIT => 'Delete Business Permit',
            self::CREATE_BUSINESS_TYPE => 'Create Business Type',
            self::READ_BUSINESS_TYPE => 'Read Business Type',
            self::UPDATE_BUSINESS_TYPE => 'Update Business Type',
            self::DELETE_BUSINESS_TYPE => 'Delete Business Type',
            self::CREATE_USER => 'Create User',
            self::READ_USER => 'Read User',
            self::UPDATE_USER => 'Update User',
            self::UPDATE_PROFILE => 'Update Profile',
            self::DELETE_USER => 'Delete User',

            self::CREATE_MEMBER => 'Create Member',
            self::READ_MEMBER => 'Read Member',
            self::UPDATE_MEMBER => 'Update Member',
            self::DELETE_MEMBER => 'Delete Member',

            self::CREATE_NEWS => 'Create News',
            self::READ_NEWS => 'Read News',
            self::UPDATE_NEWS => 'Update News',
            self::DELETE_NEWS => 'Delete News',

            self::CREATE_NEWS_CATEGORY => 'Create News Category',
            self::READ_NEWS_CATEGORY => 'Read News Category',
            self::UPDATE_NEWS_CATEGORY => 'Update News Category',
            self::DELETE_NEWS_CATEGORY => 'Delete News Category',

            self::CREATE_FAQ => 'Create FAQ',
            self::READ_FAQ => 'Read FAQ',
            self::UPDATE_FAQ => 'Update FAQ',
            self::DELETE_FAQ => 'Delete FAQ',

            self::CREATE_CREDIT_REQUEST_REQUIREMENT => 'Create Credit Request Requirement',
            self::READ_CREDIT_REQUEST_REQUIREMENT => 'Read Credit Request Requirement',
            self::UPDATE_CREDIT_REQUEST_REQUIREMENT => 'Update Credit Request Requirement',
            self::DELETE_CREDIT_REQUEST_REQUIREMENT => 'Delete Credit Request Requirement',

            self::CREATE_TESTIMONI => 'Create Testimonial',
            self::READ_TESTIMONI => 'Read Testimonial',
            self::UPDATE_TESTIMONI => 'Update Testimonial',
            self::DELETE_TESTIMONI => 'Delete Testimonial',

            self::CREATE_CREDIT_REQUEST => 'Create Credit Request',
            self::READ_CREDIT_REQUEST => 'Read Credit Request',
            self::READ_OWN_CREDIT_REQUEST => 'Read Own Credit Request',
            self::UPDATE_CREDIT_REQUEST => 'Update Credit Request',
            self::DELETE_CREDIT_REQUEST => 'Delete Credit Request',
            self::CONFIRM_CREDIT_REQUEST => 'Confirm Credit Request',
            self::APPROVE_CREDIT_REQUEST => 'Approve Credit Request',
            self::REJECT_CREDIT_REQUEST => 'Reject Credit Request',

            self::CREATE_CREDIT_TERM => 'Create Credit Term',
            self::READ_CREDIT_TERM => 'Read Credit Term',
            self::UPDATE_CREDIT_TERM => 'Update Credit Term',
            self::DELETE_CREDIT_TERM => 'Delete Credit Term',

            self::CREATE_CREDIT_REQUEST_TYPE => 'Create Credit Request Type',
            self::READ_CREDIT_REQUEST_TYPE => 'Read Credit Request Type',
            self::UPDATE_CREDIT_REQUEST_TYPE => 'Update Credit Request Type',
            self::DELETE_CREDIT_REQUEST_TYPE => 'Delete Credit Request Type',

            self::CREATE_LOCATION => 'Create Location',
            self::READ_LOCATION => 'Read Location',
            self::UPDATE_LOCATION => 'Update Location',
            self::DELETE_LOCATION => 'Delete Location',
        };
    }
}
