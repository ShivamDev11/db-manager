<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_name',
        'area',
        'city',
        'mobile_no',
        'category',
        'sub_category',
        'address',
        'duplicate_hash',
        'master_id',
        'is_duplicate',
        'is_incomplete',
    ];

    protected $casts = [
        'is_duplicate' => 'boolean',
        'is_incomplete' => 'boolean',
    ];

    /**
     * Generate duplicate hash based on name + area + city + address
     */
    public static function generateDuplicateHash($name, $area, $city, $address = null)
    {
        $string = strtolower(trim($name)) . '|' . strtolower(trim($area)) . '|' . strtolower(trim($city)) . '|' . strtolower(trim($address ?? ''));
        return hash('md5', $string);
    }

    /**
     * Check if record is incomplete
     */
    public function checkIfIncomplete()
    {
        $requiredFields = ['business_name', 'area', 'city', 'mobile_no', 'category'];
        
        foreach ($requiredFields as $field) {
            if (empty($this->{$field})) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get related duplicate records
     */
    public function duplicates()
    {
        return $this->where('duplicate_hash', $this->duplicate_hash)
            ->where('id', '!=', $this->id)
            ->get();
    }

    /**
     * Get master record if this is a duplicate
     */
    public function master()
    {
        return $this->belongsTo(Business::class, 'master_id');
    }

    /**
     * Get all records that have this record as master
     */
    public function mergedRecords()
    {
        return $this->hasMany(Business::class, 'master_id');
    }
}
