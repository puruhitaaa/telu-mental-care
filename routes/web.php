<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/* ================= STUDENT CONTROLLERS ================= */
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ConsultationRequestController;
use App\Http\Controllers\Student\MoodRecordController;
use App\Http\Controllers\Student\StressAssessmentController;
use App\Http\Controllers\Student\StudentReportController;
use App\Http\Controllers\Student\StudentFeedbackController;

/* ================= COUNSELOR CONTROLLERS ================= */
use App\Http\Controllers\Counselor\StudentRecordController;
use App\Http\Controllers\Counselor\DashboardController as CounselorDashboardController;
use App\Http\Controllers\Counselor\ScheduleController;
use App\Http\Controllers\Counselor\HighRiskController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('intro'));
Route::get('/intro', fn () => view('intro'))->name('intro');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.perform');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */
    Route::prefix('student')
        ->name('student.')
        ->middleware('student')
        ->group(function () {

            // DASHBOARD
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // PROFILE
            Route::get('/profile/edit', [ProfileController::class, 'editStudent'])
                ->name('profile.edit');

            Route::post('/profile/update', [ProfileController::class, 'updateStudent'])
                ->name('profile.update');

            // CONSULTATION REQUEST (SELALU BOLEH)
            Route::get('/request-consultation', [ConsultationRequestController::class, 'create'])
                ->name('consultation.create');

            Route::post('/request-consultation', [ConsultationRequestController::class, 'store'])
                ->name('consultation.store');

            /*
            |--------------------------------------------------------------------------
            | 🔒 FEATURE TERKUNCI (HARUS SUDAH REQUEST CONSULTATION)
            |--------------------------------------------------------------------------
            */
            Route::middleware('has.consultation')->group(function () {

                // MOOD
                Route::get('/mood-recording', [MoodRecordController::class, 'index'])
                    ->name('mood.index');

                Route::post('/mood-recording', [MoodRecordController::class, 'store'])
                    ->name('mood.store');

                // STRESS
                Route::get('/stress-assessment', [StressAssessmentController::class, 'index'])
                    ->name('stress.index');

                Route::post('/stress-assessment', [StressAssessmentController::class, 'store'])
                    ->name('stress.store');

                Route::get('/stress-assessment/result/{id}', [StressAssessmentController::class, 'result'])
                    ->name('stress.result');
            });

            // FEEDBACK
            Route::get('/counseling/{consultation}/feedback', [StudentFeedbackController::class, 'create'])->name('feedback.create');
            Route::post('/counseling/{consultation}/feedback', [StudentFeedbackController::class, 'store'])->name('feedback.store');

            // DOWNLOAD REPORT
            Route::get('/counseling-reports/{report}/download', [StudentReportController::class, 'download'])
                ->name('reports.download');
        });

    /*
    |--------------------------------------------------------------------------
    | COUNSELOR
    |--------------------------------------------------------------------------
    */
    Route::prefix('counselor')
        ->name('counselor.')
        ->middleware('counselor')
        ->group(function () {

            Route::get('/dashboard', [CounselorDashboardController::class, 'index'])
                ->name('dashboard');

            // PROFILE
            Route::get('/profile/edit', fn () => view('counselor.profile.edit'))
                ->name('profile.edit');

            Route::post('/profile/update', [ProfileController::class, 'updateCounselor'])
                ->name('profile.update');

            // SCHEDULE
            Route::get('/counseling-schedule', [ScheduleController::class, 'index'])
                ->name('schedule.index');

            Route::get('/counseling-schedule/{id}', [ScheduleController::class, 'show'])
                ->name('schedule.show');

            Route::post('/counseling-schedule/{id}/update-status', [ScheduleController::class, 'updateStatus'])
                ->name('schedule.updateStatus');

            // HIGH RISK
            Route::get('/high-risk-student', [HighRiskController::class, 'index'])
                ->name('highrisk.index');

            Route::get('/high-risk-student/export', [HighRiskController::class, 'exportCsv'])
                ->name('highrisk.exportCsv');

            Route::get('/high-risk-student/{type}/{id}', [HighRiskController::class, 'show'])
                ->name('highrisk.show');

            // STUDENT RECORDS
            Route::get('/student-records', [StudentRecordController::class, 'index'])
                ->name('records.index');

            Route::get('/student-records/{student}', [StudentRecordController::class, 'show'])
                ->name('records.show');

            Route::post('/student-records/{student}/notes', [StudentRecordController::class, 'storeNote'])
                ->name('records.notes.store');

            Route::put('/student-records/{student}/notes/{note}', [StudentRecordController::class, 'updateNote'])
                ->name('records.notes.update');

            Route::get('/student-records/{student}/export', [StudentRecordController::class, 'exportPdf'])
                ->name('records.export.pdf');
        });
});
