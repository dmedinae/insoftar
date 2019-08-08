<?php 



namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Plan_mantenimiento AS Plan;

use DB;

use Mail;

use DateTime;

use DateInterval;



class CorreoVisita extends Command

{

	protected $signature = 'correo:visita';
	protected $description = 'Email Visitas';

    public function __construct()

    {

        parent::__construct();

    }



    public function handle()

    {
        

    	$prueba = Plan::Joins()->where('plan_mantenimiento.prueba', '=', 'Si')

    		->whereRaw('plan_mantenimiento.fecha <= CURDATE()')

    		->whereRaw('plan_mantenimiento.fechaf >= CURDATE()')

    		->whereRaw('plan_mantenimiento.dia = WEEKDAY(CURDATE() + INTERVAL 1 DAY)')

    		->get();

		if($prueba->count() > 0){

			$this->data['prueba'] = $prueba;

			Mail::send('plan_mantenimiento.mail_prueba', $this->data, function($message){

				$message->from('fp@fpservices.com.co')->to('soporte@fpservices.com.co')->subject('Alerta Pruebas semanales');

			});

		}

    	$plan = Plan::Joins()->whereRaw('plan_mantenimiento.fechar = CURDATE()')->get();

		if($plan->count() > 0){

			$this->data['plan'] = $plan;

			Mail::send('plan_mantenimiento.mail_plan', $this->data, function($message){

				$message->from('fp@fpservices.com.co')->to('soporte@fpservices.com.co')->subject('Alerta Visitas');

			});

		}    	

    	$planact = Plan::Joins()->whereRaw('plan_mantenimiento.fechap = CURDATE()')->get();	

    	if($planact->count() > 0){

    		foreach ($planact as $row) {

    			if($row->fechap != $row->fechaf){

			        //Se calcula fecha proxima visita

			        $fechap = new DateTime($row->fechap);

			        $fechap->add(new DateInterval('P'.$row->frecuencia.'M'));

			        //Se calcula la fecha del proximo recordatorio

			        $fechar = new DateTime($fechap->format('Y-m-d'));

			        $fechar->sub(new DateInterval('P8D'));    				

    				$registro = Plan::find($row->id);

    				$registro->fechap = $fechap->format('Y-m-d');

    				$registro->fechar = $fechar->format('Y-m-d');

    				$registro->save();

    			}

    		}

    	}
$this->info('User Name Change Successfully!');
    }

}