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

    // Tambahkan ini agar atribut computed bisa diakses
    protected $appends = ['file_url', 'file_type', 'file_icon', 'thumbnail_url'];

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
     * Mendapatkan URL thumbnail (untuk gambar)
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->file_type == 'image') {
            return $this->file_url;
        }
        return '';
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
     * Mendapatkan icon berdasarkan tipe file - GUNAKAN FE ICONS
     */
    public function getFileIconAttribute(): string
    {
        $icons = [
            'application/pdf' => 'fe fe-file-text text-danger',
            'application/msword' => 'fe fe-file-text text-primary',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fe fe-file-text text-primary',
            'application/vnd.ms-excel' => 'fe fe-file-text text-success',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fe fe-file-text text-success',
            'image/jpeg' => 'fe fe-image text-info',
            'image/png' => 'fe fe-image text-info',
            'image/gif' => 'fe fe-image text-info',
        ];

        return $icons[$this->mime_type] ?? 'fe fe-file';
    }

    /**
     * Mendapatkan nama file tanpa extension
     */
    public function getDisplayNameAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_FILENAME);
    }

    /**
     * Mendapatkan extension file dalam huruf besar
     */
    public function getFileExtensionAttribute(): string
    {
        return strtoupper(pathinfo($this->file_name, PATHINFO_EXTENSION));
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
