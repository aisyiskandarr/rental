<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ratings Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsTo $Bookings
 * @property \App\Model\Table\VehiclesTable&\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\Rating newEmptyEntity()
 * @method \App\Model\Entity\Rating newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Rating> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rating get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Rating findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Rating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Rating> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rating|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Rating saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Rating>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rating>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rating>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rating> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rating>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rating>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rating>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rating> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatingsTable extends Table
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

        $this->setTable('ratings');
        $this->setDisplayField('rate');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Bookings', [
            'foreignKey' => 'bookings_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicles_id',
            'joinType' => 'INNER',
        ]);
		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
			->value('id')
            ->value('rate')
            
				->add('search', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['id'],
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('bookings_id')
            ->notEmptyString('bookings_id');

        $validator
            ->integer('vehicles_id')
            ->notEmptyString('vehicles_id');

        $validator
            ->scalar('rate')
            ->maxLength('rate', 100)
            ->requirePresence('rate', 'create')
            ->notEmptyString('rate');

        $validator
            ->scalar('comment')
            ->maxLength('comment', 255)
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['bookings_id'], 'Bookings'), ['errorField' => 'bookings_id']);
        $rules->add($rules->existsIn(['vehicles_id'], 'Vehicles'), ['errorField' => 'vehicles_id']);

        return $rules;
    }
}
