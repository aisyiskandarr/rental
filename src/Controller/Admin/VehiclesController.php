<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Vehicles Controller
 *
 * @property \App\Model\Table\VehiclesTable $Vehicles
 */
class VehiclesController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	/*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('vehicles', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'vehicles');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('vehicles.csv');
		$vehicles = $this->Vehicles->find();
		$_serialize = 'vehicles';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('vehicles', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$vehicles = $this->paginate($this->Vehicles);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'vehicles_List.pdf' 
			]
		);
		$this->set(compact('vehicles'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Vehicles List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
        $query = $this->Vehicles->find('search', search: $this->request->getQueryParams());
        $vehicles = $this->paginate($query);
		
		//count
		$this->set('total_vehicles', $this->Vehicles->find()->count());
		$this->set('total_vehicles_archived', $this->Vehicles->find()->where(['status' => 2])->count());
		$this->set('total_vehicles_active', $this->Vehicles->find()->where(['status' => 1])->count());
		$this->set('total_vehicles_disabled', $this->Vehicles->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Vehicles->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Vehicles->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Vehicles->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Vehicles->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Vehicles->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Vehicles->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Vehicles->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Vehicles->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Vehicles->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Vehicles->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Vehicles->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Vehicles->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->Vehicles->find();

        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $this->set(compact('vehicles', 'monthArray', 'countArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Vehicles Details');
        $vehicle = $this->Vehicles->get($id, contain: []);
        $this->set(compact('vehicle'));

        $this->set(compact('vehicle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Vehicles');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Vehicles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $vehicle = $this->Vehicles->newEmptyEntity();
        if ($this->request->is('post')) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success(__('The vehicle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
        }
        $this->set(compact('vehicle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Vehicles Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Vehicles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $vehicle = $this->Vehicles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success(__('The vehicle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
        }
        $this->set(compact('vehicle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Vehicles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $vehicle = $this->Vehicles->get($id);
        if ($this->Vehicles->delete($vehicle)) {
            $this->Flash->success(__('The vehicle has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Vehicles Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Vehicles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $vehicle = $this->Vehicles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
			$vehicle->status = 2; //archived
            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success(__('The vehicle has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The vehicle could not be archived. Please, try again.'));
        }
        $this->set(compact('vehicle'));
    }
}
