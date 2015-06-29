<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Atendimento;
use App\Apresentacao;
use App\FrequenciaUtilizacao;
use App\Medico;
use App\Medicamentos;
use App\Paciente;
use App\Unidade;
use App\ViaUtilizacao;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->seedUnidades();
		$this->seedMedicamentos();
	}

	private function seedUnidades()
	{
		DB::table('unidade')->delete();
		$pediatria   = Unidade::create(['nome' => 'Pediatria']);
		$recuperacao = Unidade::create(['nome' => 'Recuperação']);
		$psiquiatria = Unidade::create(['nome' => 'Psiquiatria']);

		DB::table('paciente')->delete();
		$novinho = Paciente::create([
			'nome'            => 'Adalberto da Silva Domingos',
			'sexo'            => 'M',
			'data_nascimento' => '2003-02-01',
			'cpf'             => 83079629001
		]);

		$preadolescente = Paciente::create([
			'nome'            => 'Marcelo Santos Silveira',
			'sexo'            => 'M',
			'data_nascimento' => '2000-05-03',
			'cpf'             => 83079629002
		]);

		$adolescente = Paciente::create([
			'nome'            => 'Roberto Santos',
			'sexo'            => 'M',
			'data_nascimento' => '1998-01-07',
			'cpf'             => 83079629003
		]);

		$piazinho = Paciente::create([
			'nome'            => 'Maicon Gonçalves',
			'sexo'            => 'M',
			'data_nascimento' => '2001-02-06',
			'cpf'             => 83079629004
		]);

		$novinha = Paciente::create([
			'nome'            => 'Vania Pascoal Silveira',
			'sexo'            => 'F',
			'data_nascimento' => '2003-09-09',
			'cpf'             => 83079629005
		]);

		$geracaox = Paciente::create([
			'nome'            => 'Vera Lucia Maciel',
			'sexo'            => 'F',
			'data_nascimento' => '1985-05-08',
			'cpf'             => 83079629006
		]);

		DB::table('medico')->delete();

		$unicomed = Medico::create([
			'crm'     => '1234567',
			'nome'    => 'Médico 1',
			'usuario' => 'medico1@hospital.org',
			'senha'   => Hash::make('password'),
		]);

		DB::table('atendimento')->delete();

		$poucoTempo = Atendimento::create([
			'data_inicio'        => date('Y-m-d H:i:s', strtotime('-45 days')),
			'data_fim'           => date('Y-m-d H:i:s', strtotime('-40 days')),
			'cod_unidade'        => $pediatria->codigo,
			'cod_paciente'       => $novinha->registro,
			'medico_responsavel' => $unicomed->crm,
		]);

		$algumTempo = Atendimento::create([
			'data_inicio' => date('Y-m-d H:i:s', strtotime('-70 days')),
			'data_fim'    => date('Y-m-d H:i:s', strtotime('-30 days')),
			'cod_unidade' => $recuperacao->codigo,
			'cod_paciente' => $preadolescente->registro,
			'medico_responsavel' => $unicomed->crm,
		]);

		$demorado = Atendimento::create([
			'data_inicio' => date('Y-m-d H:i:s', strtotime('-100 days')),
			'data_fim'    => date('Y-m-d H:i:s', strtotime('-15 days')),
			'cod_unidade' => $psiquiatria->codigo,
			'cod_paciente' => $geracaox->registro,
			'medico_responsavel' => $unicomed->crm,
		]);

		$recente = Atendimento::create([
			'data_inicio' => date('Y-m-d H:i:s', strtotime('-15 days')),
			'data_fim'    => date('Y-m-d H:i:s', strtotime('-3 days')),
			'cod_unidade' => $recuperacao->codigo,
			'cod_paciente' => $novinho->registro,
			'medico_responsavel' => $unicomed->crm,
		]);
	}

	private function seedMedicamentos() {
		DB::table('cadastro_apresentacao')->delete();

		$frasco = Apresentacao::create([
			'descricao' => 'Frasco', 'abreviacao' => 'unid'
		]);
		$ampola = Apresentacao::create([
			'descricao' => 'Ampola', 'abreviacao' => 'unid'
		]);
		$comprimido = Apresentacao::create([
			'descricao' => 'Comprimido', 'abreviacao' => 'unid'
		]);

		DB::table('cadastro_via')->delete();

		$oral = ViaUtilizacao::create([
			'descricao' => 'Oral', 'abreviacao' => 'oral'
		]);

		$nasal = ViaUtilizacao::create([
			'descricao' => 'Nasal', 'abreviacao' => 'nasal'
		]);

		$intra = ViaUtilizacao::create([
			'descricao' => 'Intravenosa', 'abreviacao' => 'intra'
		]);

		$ocular = ViaUtilizacao::create([
			'descricao' => 'Ocular', 'abreviacao' => 'ocular'
		]);


		DB::table('cadastro_frequencia')->delete();

		$hr1 = FrequenciaUtilizacao::create(['descricao' => 'A cada hora']);
		$hr2 = FrequenciaUtilizacao::create(['descricao' => 'A cada 2 horas']);
		$hr3 = FrequenciaUtilizacao::create(['descricao' => 'A cada 3 horas']);
		$hr4 = FrequenciaUtilizacao::create(['descricao' => 'A cada 4 horas']);
		$hr5 = FrequenciaUtilizacao::create(['descricao' => 'A cada 5 horas']);
		$hr6 = FrequenciaUtilizacao::create(['descricao' => 'A cada 6 horas']);
		$p3x = FrequenciaUtilizacao::create(['descricao' => 'Três vezes ao dia']);
		$p2x = FrequenciaUtilizacao::create(['descricao' => 'Duas vezes ao dia']);
		$p1x = FrequenciaUtilizacao::create(['descricao' => 'Uma dose diária']);
		$uni = FrequenciaUtilizacao::create(['descricao' => 'Dose única']);
		$cri = FrequenciaUtilizacao::create(['descricao' => 'Somente sob crise']);

		DB::table('medicamento_apresentacao')->delete();
		DB::table('medicamento_via')->delete();
		DB::table('medicamento_frequencia')->delete();

		DB::table('cadastro_medicamentos')->delete();

		$omepazol = Medicamentos::create(['nome' => 'Omepazol']);
		$tomazin  = Medicamentos::create(['nome' => 'Tomazin']);
		$dipirona = Medicamentos::create(['nome' => 'Dipirona']);

		$omepazol->frequencias()->attach($hr1->codigo);
		$omepazol->frequencias()->attach($hr2->codigo);
		$omepazol->frequencias()->attach($hr3->codigo);
		$omepazol->frequencias()->attach($hr4->codigo);
		$omepazol->frequencias()->attach($hr5->codigo);
		$omepazol->frequencias()->attach($hr6->codigo);
		$omepazol->frequencias()->attach($p3x->codigo);
		$omepazol->frequencias()->attach($p2x->codigo);
		$omepazol->frequencias()->attach($p1x->codigo);
		$omepazol->frequencias()->attach($uni->codigo);
		$omepazol->frequencias()->attach($cri->codigo);

		$tomazin->frequencias()->attach($hr1->codigo);
		$tomazin->frequencias()->attach($hr3->codigo);
		$tomazin->frequencias()->attach($hr5->codigo);
		$tomazin->frequencias()->attach($p3x->codigo);
		$tomazin->frequencias()->attach($p1x->codigo);
		$tomazin->frequencias()->attach($cri->codigo);

		$dipirona->frequencias()->attach($hr1->codigo);
		$dipirona->frequencias()->attach($hr2->codigo);
		$dipirona->frequencias()->attach($hr3->codigo);
		$dipirona->frequencias()->attach($hr4->codigo);
		$dipirona->frequencias()->attach($hr5->codigo);
		$dipirona->frequencias()->attach($hr6->codigo);

		$tomazin->vias()->attach($oral->codigo);
		$tomazin->vias()->attach($intra->codigo);
		$omepazol->vias()->attach($nasal->codigo);
		$dipirona->vias()->attach($intra->codigo);

		$tomazin->apresentacao()->attach($frasco->codigo);
		$tomazin->apresentacao()->attach($comprimido->codigo);
		$omepazol->apresentacao()->attach($ampola->codigo);
		$omepazol->apresentacao()->attach($frasco->codigo);
		$dipirona->apresentacao()->attach($comprimido->codigo);
	}
}
