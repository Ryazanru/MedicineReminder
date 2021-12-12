<?php require_once __DIR__.'/vendor/autoload.php';

use GO\Scheduler;

// Create a new scheduler
$scheduler = new Scheduler();

// ... configure the scheduled jobs (see below) ...

//$scheduler->php('./mail.php')->everyMinute();
// $scheduler = new Scheduler([
//     'email' => [
//         'subject' => 'Visitors count',
//         'from' => 'tehothrdanman@gmail.com',
//         'body' => 'This is the daily visitors count',
//         'transport' => Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
//             ->setUsername('tehothrdanman@gmail.com')
//             ->setPassword('reallydanman'),
//         'ignore_empty_output' => false,
//     ]
// ]);

$scheduler->php('mail.php')->output([
    'my_file1.log', 'my_file2.log'
]);
// Let the scheduler execute jobs which are due.
$scheduler->run();

?>