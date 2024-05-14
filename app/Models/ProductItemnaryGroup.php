<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductItemnaryGroup extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const TYPE_SINGLE_SELECT = 1;
    const TYPE_MULTI_SELECT = 2;

    public static $status = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];
    public static $types = [
        self::TYPE_SINGLE_SELECT => 'Mandatory',
        self::TYPE_MULTI_SELECT => 'Optional',
    ];
    protected $table      = 'products_itemnary_group';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'type', 'icons', 'status', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;

    public function ItemnaryGroup($ids = null)
    {
        $groups = [];
        if ($ids == null) {
            foreach ($this->where('status',self::STATUS_ACTIVE)->orderBy('id DESC')->asArray()->findAll() as $value) {
                $itemnaryModel = new \App\Models\ProductItemnary();
                $value['items'] = $itemnaryModel->Itemnary($value['id']);
                array_push($groups, $value);
            }
        } else {
            foreach ($this->asArray()->whereIn('id', $ids)->where('status',self::STATUS_ACTIVE)->orderBy('id DESC')->findAll() as $value) {
                $itemnaryModel = new \App\Models\ProductItemnary();
                $value['items'] = $itemnaryModel->Itemnary($value['id']);
                array_push($groups, $value);
            }
        }
        return $groups;
    }
}
