<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Mendapatkan path lengkap file
     */
    public function getFilePathAttribute(): string
    {
        return 'proyek_files/' . $this->file_name;
    }

    /**
     * Mendapatkan URL untuk mengakses file
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/proyek_files/' . $this->file_name);
    }

    /**
     * Mendapatkan tipe file (image atau document)
     */
    public function getFileTypeAttribute(): string
    {
        $imageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($this->mime_type, $imageTypes) ? 'image' : 'document';
    }

    /**
     * Menghapus file fisik dari storage saat model dihapus
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            Storage::disk('public')->delete('proyek_files/' . $media->file_name);
        });
    }
}
