<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\MeetController as AdminMeetController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\CareerJobsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SkillPathController;

use App\Http\Controllers\TaskController;

use App\Http\Controllers\UserpostController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetController;







Route::get('/',[HomeController::class,'index'])->name('home');

Route::post('/improve-document', [DashboardController::class, 'improve'])->name('document.improve')->middleware('auth');

Route::post('/export-pdf', [DashboardController::class, 'exportPdf'])->name('export.pdf');

Route::post('/career/download-pdf', [DashboardController::class, 'downloadResumePdf'])->name('career.downloadPdf');

Route::post('/export-word', [DashboardController::class, 'exportWord'])->name('export.word');

Route::get('/clear', function () {

    Artisan::call('route:cache');

    Artisan::call('config:cache');
    Artisan::call('cache:clear');
        
    return "Cleared asdf!";});
    
    Route::get('/clearmigrate', function () {

    Artisan::call('migrate:refresh --path=/database/migrations/2025_03_03_174738_create_settings_table.php');
    return "Cleared migrate!";});

    Route::get('/auto-config', function () {

        Artisan::call('config:clear');
        return "auto!";
    });
Route::get('/affiliate-programs',[DashboardController::class,'Affiliate'])->name('affiliate-programs');
Route::get('/forum',[DashboardController::class,'forum'])->name('forum.web');
Route::get('/forum/{id}',[DashboardController::class,'forum_forum'])->name('forum.forum.web');
Route::get('/forum/topic/{id}',[DashboardController::class,'forum_topic'])->name('forum.topic.web');


Route::get('/career/job',[DashboardController::class,'career'])->name('career.web');
Route::get('jobs/list/{id}',[DashboardController::class,'jobs'])->name('jobs.web');
Route::get('jobs/detail/{id}',[DashboardController::class,'jobs_detail'])->name('jobs.detail.web');

// Route::get('/Login', function () {
//     return view('login');
// });
Route::get('/workshops',[DashboardController::class,'Workshops'])->name('workshops');
Route::get('/travel-mobility',[DashboardController::class,'TravelMobility'])->name('travel-mobility');

Route::group(['prefix'=> 'account'],function(){
//guest middleware
Route::match(['get', 'post'], '/resend-verification', [LoginController::class, 'resendVerificationEmail'])
    ->name('resend.verification');


Route::group(['middleware' => 'guest'],function(){




    Route::post('/verify-student-card', [LoginController::class, 'verifyStudentCard'])->name('student.verify.card');
    
    Route::get('/verify-email/{id}', [LoginController::class, 'verifyEmail'])
    ->name('verification.verify')
    ->middleware('signed');




    
    
    Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
    Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
    
    Route::get('/upload-student-card', [LoginController::class, 'showUploadCardForm'])
    ->name('student.upload.card')
    ->middleware('unverified','redirect.if.session.forgotten');

    Route::get('/log-out/session', [LoginController::class, 'logoutsession'])
    ->name('logout.session');



    
  
    Route::get('register',[LoginController::class,'register'])->name('account.register');
    Route::get('login',[LoginController::class,'index'])->name('account.login');


    
    Route::get('google/user',[LoginController::class,'register_google'])->name('register.google');


    Route::get('facebbok/user',[LoginController::class,'facebook_login'])->name('register.facebook');
    Route::any('facebook/user', [LoginController::class, 'callbackFromFacebbokregister'])->name('callback.register.facebook');
    

Route::get('login/github', [LoginController::class, 'redirectToGitHub'])->name('github.login');
Route::get('github/callback', [LoginController::class, 'handleGitHubCallback'])->name('github.login.submit');


    Route::get('apple/user', [LoginController::class, 'redirectToApple'])->name('apple.register');
    Route::post('apple/callback', [LoginController::class, 'handleAppleCallback'])->name('callback.register.apple');
});


Route::middleware(['auth', 'verified'])->group(function () {
    //authenticated middleware
    
    Route::controller(UserpostController::class)->group(function(){
        Route::get('user/post','index')->name('account.post.index');
        Route::get('user/post/create','create')->name('account.post.create');
        Route::post('user/post/store','store')->name('account.post.store');
        Route::get('user/post/edit/{id}','edit')->name('account.post.edit');
        Route::delete('user/post/update','update')->name('account.post.update');
        Route::get('user/post/status','status')->name('account.post.status');
        Route::delete('user/post/delete/{id}','destroy')->name('account.post.destroy');
});

            Route::controller(MeetController::class)->group(function(){
        Route::get('user/events','index')->name('user.event.index');
        Route::get('user/event/create','create')->name('user.event.create');
        Route::post('user/event/store','store')->name('user.event.store');
        Route::get('user/event/edit/{id}','edit')->name('user.event.edit');
        Route::post('user/event/update','update')->name('user.event.update');
        Route::get('user/event/status','status')->name('user.event.status');
        Route::delete('user/event/delete/{id}','destroy')->name('user.event.destroy');
});



Route::post('/post/follow-toggle', [FollowerController::class, 'toggle'])->name('post.toggleFollow');
Route::get('/user/discussions/load', [DashboardController::class, 'loadMore'])->name('user.discussions.load');

Route::post('account/group/{group}', [GroupController::class, 'join'])->name('group.join');

  Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::put('/groups/{id}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
    Route::get('/groups/{id}/json', [GroupController::class, 'getGroupJson'])->name('groups.json'); // for AJAX edit
    
    Route::get('/user-search', [DashboardController::class, 'search'])->name('user.search');


    Route::get('/community',[DashboardController::class,'Community'])->name('account.community');
    Route::get('/calendar/task',[DashboardController::class,'calendar_task'])->name('account.calendar.Task');
    Route::get('/task/show',[DashboardController::class,'task_show'])->name('account.Task.show');
    Route::get('/notification',[DashboardController::class,'Notification'])->name('account.notification');
    Route::get('/financial',[DashboardController::class,'Financial_Planning'])->name('account.financial');
    Route::get('/study',[DashboardController::class,'Study_Assistant'])->name('account.study');
    Route::get('/career',[DashboardController::class,'careerPlanning'])->name('account.career');
    Route::get('/document',[DashboardController::class,'document'])->name('document');
    Route::get('/ai',[DashboardController::class,'ai'])->name('account.ai');
    Route::post('expense-export',[DashboardController::class,'exportExpenses'])->name('Expenses.export');
    Route::get('/interest-notification',[DashboardController::class,'interestnoti'])->name('account.interest.notification');
    Route::get('/show/task',[DashboardController::class,'show_task'])->name('account.show.task');
    
    Route::get('/show/all/task',[TaskController::class,'show_alltask'])->name('account.show.allTask');
    Route::delete('/show/task/delete/{id}',[TaskController::class,'destroy'])->name('account.show.allTask.destroy');
    Route::post('edit/task/',[TaskController::class,'edit'])->name('account.task.edit');
    Route::post('update/task/',[TaskController::class,'update'])->name('account.task.update'); 
    Route::post('/gemini/generate', [GeminiController::class, 'generate'])->name('gemini.study');
    Route::post('/career/generate-resume', [GeminiController::class, 'generateResume'])->name('career.generateResume');

    Route::post('/check-plagiarism', [GeminiController::class, 'checkPlagiarism'])->name('plagiarism.check');

    Route::get('stress-management', [GeminiController::class, 'stress_manag'])->name('account.stress.managae');
    Route::post('/generate-tips', [GeminiController::class, 'generateTips'])->name('generate.tips');
    
        Route::get('relevant-workshop',[GeminiController::class,'relavant_workshop'])->name('account.relavant_workshop');
    Route::post('recommend-workshops', [GeminiController::class, 'recommendWorkshops']);
    Route::post('/recommend-events', [GeminiController::class, 'recommendEvents']);
    Route::post('/register-event', [GeminiController::class, 'registerEvent']);
    
    Route::get('/skill-coach', [GeminiController::class, 'skillcoach'])->name('skill.coach');
    Route::post('/select-skill-path', [GeminiController::class, 'storeskillpath'])->name('user.selectSkillPath');

    Route::get('/career/assiatant', [GeminiController::class, 'careerassistant'])->name('career.assistant');
    
    Route::post('/topics', [DiscussionController::class, 'storeTopic'])->name('discussion.storeTopic');
    Route::get('/topics', [DiscussionController::class, 'getTopics'])->name('discussion.getTopics');
    Route::post('/send-message', [DiscussionController::class, 'sendMessage'])->name('discussion.send');
    Route::post('/discussion/topic/delete/{id}', [DiscussionController::class, 'deleteTopic'])->name('discussion.deleteTopic');
    Route::post('/process-document', [DashboardController::class, 'processDocument'])->name('document.process');
    Route::post('/financial/analyze', [DashboardController::class, 'analyzeFinances'])->name('finan');
    Route::post('/quiz/generate', [QuizController::class, 'generateQuiz'])->name('generate.quiz');

    Route::get('/quiz/question/solve/{id}', [QuizController::class, 'quizquestionsolver'])->name('quiz.question.solve');

    Route::post('/quiz/submit', [QuizController::class, 'submitQuizAttempt'])
    ->name('quiz.submitAttempt');
    
    Route::get('/toolkit', [GeminiController::class, 'Toolkit'])->name('toolkit.all');
    Route::get('/toolkit/{tool}', [GeminiController::class, 'showTool'])->name('toolkit.tool');
    Route::post('/toolkit/run/{tool}', [GeminiController::class, 'runTool'])->name('toolkit.run');
    
    Route::post('/chat-assistant/ask', [GeminiController::class, 'ask'])->name('chat.assistant.ask');

Route::post('/update-profile/{id}',[DashboardController::class,'updateProfile'])->name('account.update-profile');
    Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
    Route::get('profile',[DashboardController::class,'userProfile'])->name('account.profile');

    Route::get('/get-jobs', [DashboardController::class, 'getJobs'])->name('account.getjobs');

    Route::get('dashboard',[DashboardController::class,'index'])->name('account.dashboard');
    Route::post('task',[TaskController::class,'store'])->name('account.task.store');

    
    Route::get('task/google',[TaskController::class,'googleTask'])->name('account.task.google');
    
    Route::get('/user/calendar-events', [TaskController::class, 'getUserEvents'])->name('account.user.calender');

    Route::post('/mark-notifications-read', [DashboardController::class, 'markAsRead'])->name('notifications.markRead');

    Route::get('/user/workshop', [DashboardController::class, 'user_workshopshow'])->name('user.workshop.show');
    Route::get('/user/ticketbook', [DashboardController::class, 'user_ticketbook'])->name('user.ticketbook.show');
    Route::get('/user/affiliate-programs', [DashboardController::class, 'user_affiliate_programs'])->name('user.affiliate_programs.show');
                

});
Route::get('/enroll/{module_type}/{module_id}',[PaymentController::class,'index'])->name('account.enroll');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');


});
    Route::any('account/callback', [LoginController::class, 'callbackFromGoogleregister'])->name('callback.register');






Route::group(['prefix'=> 'admin'],function(){
    //admin middleware
    
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');

        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });
    
    Route::group(['middleware' => 'admin.auth'],function(){

    Route::get('general-setting',[AdminDashboardController::class,'setting'])->name('general.setting');
    Route::post('general-setting-submit',[AdminDashboardController::class,'settingsubmit'])->name('general.setting.submit');

            Route::controller(AdminMeetController::class)->group(function(){
        Route::get('events','index')->name('admin.event.index');
        Route::get('event/create','create')->name('admin.event.create');
        Route::post('event/store','store')->name('admin.event.store');
        Route::get('event/edit/{id}','edit')->name('admin.event.edit');
        Route::post('event/update','update')->name('admin.event.update');
        Route::get('event/status','status')->name('admin.event.status');
        Route::delete('event/delete/{id}','destroy')->name('admin.event.destroy');
});



        Route::controller(SkillPathController::class)->group(function(){
        Route::get('skill/path','index')->name('skillpath.index');
        Route::get('skill/path/create','create')->name('skillpath.create');
        Route::post('skill/path/store','store')->name('skillpath.store');
        Route::get('skill/path/edit/{id}','edit')->name('skillpath.edit');
        Route::post('skill/path/update','update')->name('skillpath.update');
        Route::get('skill/path/status','status')->name('skillpath.status');
        Route::delete('skill/path/delete/{id}','destroy')->name('skillpath.destroy');

        // Route::get('category/sub-category/{id}','indexsubcategory')->name('category.index.subcategory');
        // Route::get('category/create/sub-category/{id}','createsubcategory')->name('category.create.subcategory');
        // Route::post('category/store/sub-category/','storesubcategory')->name('category.store.subcategory');
    });


    Route::controller(CategoryController::class)->group(function(){
        Route::get('category','index')->name('category.index');
        Route::get('category/create','create')->name('category.create');
        Route::post('category/store','store')->name('category.store');
        Route::get('category/edit/{id}','edit')->name('category.edit');
        Route::post('category/update','update')->name('category.update');
        Route::get('category/status','status')->name('category.status');
        Route::delete('category/delete/{id}','destroy')->name('category.destroy');

        Route::get('category/sub-category/{id}','indexsubcategory')->name('category.index.subcategory');
        Route::get('category/create/sub-category/{id}','createsubcategory')->name('category.create.subcategory');
        Route::post('category/store/sub-category/','storesubcategory')->name('category.store.subcategory');
    });


    Route::controller(PostController::class)->group(function(){
        Route::get('post','index')->name('post.index');
        Route::get('post/create','create')->name('post.create');
        Route::post('post/store','store')->name('post.store');
        Route::get('post/edit/{id}','edit')->name('post.edit');
        Route::post('post/update','update')->name('post.update');
        Route::get('post/status','status')->name('post.status');
        Route::delete('post/delete/{id}','destroy')->name('post.destroy');

        Route::get('post/sub-category/{id}','indexsubcategory')->name('post.index.subcategory');
        Route::get('post/create/sub-category/{id}','createsubcategory')->name('post.create.subcategory');
        Route::post('post/store/sub-category/','storesubcategory')->name('post.store.subcategory');
});

    Route::controller(CareerJobsController::class)->group(function(){
        Route::get('career','index')->name('career.index');
        Route::get('career/create','create')->name('career.create');
        Route::post('career/store','store')->name('career.store');
        Route::get('career/edit/{id}','edit')->name('career.edit');
        Route::post('career/update','update')->name('career.update');
        Route::get('career/status','status')->name('career.status');
        Route::delete('career/delete/{id}','destroy')->name('career.destroy');
});
            
    Route::post('/process-document', [DashboardController::class, 'processDocument'])->name('admin.document.process');
        Route::get('/ai',[AdminDashboardController::class,'ai'])->name('admin.ai');
        Route::get('/document',[AdminDashboardController::class,'document'])->name('admin.document');
        //authenticated middleware
        Route::get('user-management',[AdminDashboardController::class,'userManagement'])->name('admin.user-management');
        Route::get('workshops',[AdminDashboardController::class,'Workshops'])->name('admin.workshops');
        Route::get('affiliate-programs',[AdminDashboardController::class,'AffiliatePrograms'])->name('admin.affiliate-programs');

        Route::get('travel-mobility',[AdminDashboardController::class,'TravelMobility'])->name('admin.travel-mobility');

        Route::get('content-management',[AdminDashboardController::class,'contentManagement'])->name('admin.content-management');
Route::post('/add-workshop',[AdminDashboardController::class,'addWorkshops'])->name('admin.add-workshops');
        Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/edit-workshop/{id}', [AdminDashboardController::class, 'editWorkshop'])->name('admin.edit-workshop');

        Route::delete('/delete-user/{id}',[AdminDashboardController::class,'deleteUser'])->name('admin.user-delete');
        Route::delete('/delete-workshop/{id}',[AdminDashboardController::class,'deleteWorkshop'])->name('admin.workshop-delete');
        Route::post('/update-workshop/{id}',[AdminDashboardController::class,'updateWorkshops'])->name('admin.update-workshop');

        Route::post('/add-affiliate',[AdminDashboardController::class,'addAffiliate'])->name('admin.add-affiliate');
        Route::get('/edit-affiliate/{id}', [AdminDashboardController::class, 'editAffiliate'])->name('admin.edit-affiliate');
        Route::delete('/delete-affiliate/{id}',[AdminDashboardController::class,'deleteAffiliate'])->name('admin.affiliate-delete');
        Route::post('/update-affiliate/{id}',[AdminDashboardController::class,'updateAffiliate'])->name('admin.affiliate-update');

        Route::post('/update-user/{id}',[AdminDashboardController::class,'updateUserDetails'])->name('admin.update-user');
        Route::get('/edit-user/{id}', [AdminDashboardController::class, 'editUserDetails'])->name('admin.edit-user');

        Route::post('/add-travel-mobility',[AdminDashboardController::class,'travelmobilityAdd'])->name('admin.add-travel-mobility');
        Route::delete('/delete-travel-mobility/{id}',[AdminDashboardController::class,'deleteTravelMobility'])->name('admin.travel-mobility-delete');
        Route::get('/edit-travel/{id}', [AdminDashboardController::class, 'editTravelMobility'])->name('admin.edit-travel');
        Route::post('/update-travel/{id}',[AdminDashboardController::class,'updateTravelMobility'])->name('admin.update-travel');
        Route::get('/content-management-home',[AdminDashboardController::class,'ContentHome'])->name('content.home');
        Route::post('/update-home-content', [AdminDashboardController::class, 'UpdateHomeContent'])->name('content.update-home');
        Route::get('/profile',[AdminDashboardController::Class,'profile'])->name('admin.profile');
        Route::post('/update-profile/{id}',[AdminDashboardController::class,'updateProfile'])->name('admin.update-profile');
        Route::post('/add-appointments', [AdminDashboardController::class, 'addAppointments'])->name('appointments.store');
    });

    });

    Route::get('/Workshop-detail/{id}',[DashboardController::class,'workshopDetail'])->name('workshop-detail');
    Route::get('/affiliate-programs-detail/{id}', [DashboardController::class, 'AffiliateDetail'])
    ->name('affiliate-programs-detail');
    Route::get('/travel-mobility-subcategory/{id}', [DashboardController::class, 'TravelMobilitySubCategory'])
    ->name('travel-mobility-subcategory');
    Route::get('/travel-mobility-details/{id}', [DashboardController::class, 'TravelMobilityDetails'])
    ->name('travel-mobility-details');
    
        Route::get('meet',[DashboardController::class,'meet'])->name('account.meet');
        Route::get('meet/category/{slug}',[DashboardController::class,'meetcategory'])->name('account.meet.category');
        Route::get('meet/detail/{slug}',[DashboardController::class,'meetcategorydetail'])->name('account.meet.category.detail');
        
    
Route::get('meet/session/create/{slug}',[DashboardController::class,'session_meet'])->name('account.meet.session');
                        
Route::get('/meet/search', [DashboardController::class, 'searchmeet'])->name('meet.search');
            
    Route::get('account/create/user/post/{id}',[DashboardController::class,'create_user_post'])->name('account.create.user.post');
    Route::post('/comment/store', [ForumController::class, 'storeComment'])->name('comment.store');
Route::post('/comment/react', [ForumController::class, 'reactToComment'])->name('comment.react');

Route::post('/comment/react', [ForumController::class, 'reactToComment'])->name('comment.react');
