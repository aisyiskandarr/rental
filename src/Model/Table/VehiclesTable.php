<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vehicles Model
 *
 * @method \App\Model\Entity\Vehicle newEmptyEntity()
 * @method \App\Model\Entity\Vehicle newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Vehicle> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Vehicle findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Vehicle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Vehicle> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Vehicle saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Vehicle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vehicle>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vehicle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vehicle> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vehicle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vehicle>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vehicle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vehicle> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VehiclesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('vehicles');
        $this->setDisplayField('model');
        $this->setPrimaryKey('id');

                $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'fields' => [
                    'dir' => 'image_dir',
                ],
            ],
        ]);

        $this->addBehavior('Timestamp');
		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
			->value('id')
            ->value('model')
            ->value('manufacturer')
            ->value('registration_no')
            ->value('color')
            ->value('type')
            ->value('status')
				->add('status', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['status'],
				]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('model')
            ->maxLength('model', 100)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        $validator
            ->scalar('manufacturer')
            ->maxLength('manufacturer', 100)
            ->requirePresence('manufacturer', 'create')
            ->notEmptyString('manufacturer');

        $validator
            ->scalar('registration_no')
            ->maxLength('registration_no', 50)
            ->requirePresence('registration_no', 'create')
            ->notEmptyString('registration_no');

        $validator
            ->scalar('color')
            ->maxLength('color', 100)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');

        $validator
            ->scalar('type')
            ->maxLength('type', 100)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('rate_perhour')
            ->maxLength('rate_perhour', 255)
            ->requirePresence('rate_perhour', 'create')
            ->notEmptyString('rate_perhour');

        $validator
        ->allowEmptyFile('image')
        ->add('image', [
            'validExtension' => [
                'rule' => ['extension', ['jpg']],
                'message'=>('Only .jpg are allowed')
            ]
        ]);

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }
}
