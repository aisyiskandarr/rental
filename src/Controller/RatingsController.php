<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Ratings Controller
 *
 * @property \App\Model\Table\RatingsTable $Ratings
 */
class RatingsController extends AppController
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
        $this->set('ratings', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'ratings');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('ratings.csv');
		$ratings = $this->Ratings->find();
		$_serialize = 'ratings';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('ratings', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
        $this->paginate = [
            'contain' => ['Users', 'Bookings', 'Vehicles'],
			'maxLimit' => 10,
        ];
		$ratings = $this->paginate($this->Ratings);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'ratings_List.pdf' 
			]
		);
		$this->set(compact('ratings'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Ratings List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
        $query = $this->Ratings->find('search', search: $this->request->getQueryParams())
            ->contain(['Users', 'Bookings', 'Vehicles']);
			//->where(['title IS NOT' => null])
        $ratings = $this->paginate($query);
		
		//count
		$this->set('total_ratings', $this->Ratings->find()->count());
		$this->set('total_ratings_archived', $this->Ratings->find()->where(['status' => 2])->count());
		$this->set('total_ratings_active', $this->Ratings->find()->where(['status' => 1])->count());
		$this->set('total_ratings_disabled', $this->Ratings->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Ratings->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Ratings->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Ratings->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Ratings->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Ratings->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Ratings->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Ratings->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Ratings->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Ratings->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Ratings->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Ratings->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Ratings->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->Ratings->find();

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
        $users = $this->Ratings->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ratings', 'users', 'monthArray', 'countArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Ratings Details');
        $rating = $this->Ratings->get($id, contain: ['Users', 'Bookings', 'Vehicles']);
        $this->set(compact('rating'));

        $this->set(compact('rating'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Ratings');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Ratings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $rating = $this->Ratings->newEmptyEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Ratings->Users->find('list', ['limit' => 200])->all();
        $bookings = $this->Ratings->Bookings->find('list', ['limit' => 200])->all();
        $vehicles = $this->Ratings->Vehicles->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'bookings', 'vehicles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Ratings Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Ratings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $rating = $this->Ratings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
		$users = $this->Ratings->Users->find('list', limit: 200)->all();
		$bookings = $this->Ratings->Bookings->find('list', limit: 200)->all();
		$vehicles = $this->Ratings->Vehicles->find('list', limit: 200)->all();
        $this->set(compact('rating', 'users', 'bookings', 'vehicles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Ratings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Ratings->get($id);
        if ($this->Ratings->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Ratings Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Ratings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $rating = $this->Ratings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
			$rating->status = 2; //archived
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The rating could not be archived. Please, try again.'));
        }
        $this->set(compact('rating'));
    }
}
