<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Unit;
use App\Models\Position;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CertificateImport implements ToCollection, WithHeadingRow
{
    /*
    |--------------------------------------------------------------------------
    | Counter
    |--------------------------------------------------------------------------
    */

    public int $success = 0;

    public int $failed = 0;

    public int $duplicate = 0;

    public int $unmatched = 0;

    public int $newUnits = 0;

    public int $newPositions = 0;

    /*
    |--------------------------------------------------------------------------
    | Collection
    |--------------------------------------------------------------------------
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (!$this->validateRow($row)) {

                continue;
            }

            $this->importRow($row);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Summary
    |--------------------------------------------------------------------------
    */

    public function summary()
    {
        return [

            'success' => $this->success,

            'failed' => $this->failed,

            'duplicate' => $this->duplicate,

            'unmatched' => $this->unmatched,

            'new_units' => $this->newUnits,

            'new_positions' => $this->newPositions,

        ];
    }

    /*
|--------------------------------------------------------------------------
| Validate Row
|--------------------------------------------------------------------------
*/

    private function validateRow($row): bool
    {

         /*Required column*/

        $required = [

            'perner',

            'jabatan',

            'unit',

            'judul_sertifikasi',

            'tanggal_terbit_sertifikat',

            'nomor_sertifikat',

            'lembaga_sertifikasi',

            'akreditor',

        ];

        foreach ($required as $column) {

            if (empty(trim($row[$column] ?? ''))) {

                $this->failed++;

                return false;
            }
        }

          /*Duplicate logic*/

        if (

            Certificate::where(

                'certificate_number',

                trim($row['nomor_sertifikat'])

            )->exists()

        ) {

            $this->duplicate++;

            return false;
        }

        return true;
    }

        /*Import row*/

    private function importRow($row): void
    {
        try {

               /*Unit*/

            $unit = Unit::firstOrCreate([

                'name' => trim($row['unit'])

            ]);

            if ($unit->wasRecentlyCreated) {

                $this->newUnits++;
            }

               /*Position*/

            $position = Position::firstOrCreate([

                'name' => trim($row['jabatan'])

            ]);

            if ($position->wasRecentlyCreated) {

                $this->newPositions++;
            }

               /*Find User*/

            $user = User::where(

                'perner',
                trim($row['perner'])

            )->first();

             /*Create Certificate*/

            Certificate::create([

                'user_id' => $user?->id,

                'perner' => trim($row['perner']),

                'title' => trim($row['judul_sertifikasi']),

                'certificate_number' => trim($row['nomor_sertifikat']),

                'registration_number' => filled($row['nomor_registrasi'] ?? null)
                    ? trim($row['nomor_registrasi'])
                    : null,

                'institution' => trim($row['lembaga_sertifikasi']),

                'accreditor' => trim($row['akreditor']),

                'issue_date' => $this->parseDate(
                    $row['tanggal_terbit_sertifikat']
                ),

                'start_date' => $this->parseDate(
                    $row['tanggal_mulai_pelaksanaan'] ?? null
                ),

                'end_date' => $this->parseDate(
                    $row['tanggal_selesai_pelaksanaan'] ?? null
                ),

                'expired_at' => null,

                'pdf' => null,

                'remarks' => null,

                'created_by' => Auth::id(),

                'is_matched' => $user ? true : false,

            ]);

            /*Counter*/

            if (!$user) {

                $this->unmatched++;
            }

            $this->success++;
        } catch (\Throwable $e) {

            $this->failed++;
        }
    }

       /*Parse Date*/

    private function parseDate($value): ?string
    {
        if (blank($value)) {

            return null;
        }

        try {

           /*Excel Number*/

            if (is_numeric($value)) {

                return Carbon::instance(
                    Date::excelToDateTimeObject($value)
                )->format('Y-m-d');
            }
                
            /*Normal Date*/

            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $e) {

            return null;
        }
    }
}
