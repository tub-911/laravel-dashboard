<?php

namespace App\Models\BuildingType\Traits;

/**
 * Class BuildingTypeAttribute.
 */
trait BuildingTypeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                '.$this->getEditButtonAttribute("edit-buildingtype", "admin.buildingtypes.edit").'
                '.$this->getDeleteButtonAttribute("delete-buildingtype", "admin.buildingtypes.destroy").'
                </div>';
    }
}
