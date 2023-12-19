<?php

namespace App\Services\user;

use Illuminate\Support\Facades\DB;




class UserServiceQueryImpl implements IUserServiceQuery
{

    private $table = 'user';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*',
            )
;    }

    public function exclude($ids = [])
    {
        $this->query->whereNotIn('user.id', $ids);
        return $this;
    }



    public function withLimits($filters)
    {
        if (!empty($filters->length)) {
            $this->query->limit($filters->length);
        }

        if (!empty($filters->start)) {

            $this->query->offset($filters->start);

            if (empty($filters->length)) {
                $this->query->limit(10);
            }
        }
        return $this;
    }

    public function count()
    {
        return $this->query->count();
    }

    public function withFilters($filters)
    {

        if (!empty($filters->search['value'])) {
            $this->query->where(function ($query) use ($filters) {
                $cls = [
                    $this->table . '.name',
                    $this->table . '.last_name',
                    $this->table . '.code',
                    $this->table . '.email',
                    $this->table . '.phone',
                    'country.name',
                ];
                foreach (explode(' ', $filters->search['value']) as $value) {
                    foreach ($cls as $cl) {
                        $query->orWhere($cl, 'like', '%' . $value . '%');
                    }
                }
            });
        }
        return $this;
    }




    public function deleted($bool = true)
    {
        if ($bool === true) {
            $this->query->where($this->table . '.deleted_at', '!=', null);
        } else {
            $this->query->where($this->table . '.deleted_at', null);
        }
        return $this;
    }



    public function active($bool = true)
    {
        $this->query->where($this->table . '.active', $bool);
        return $this;
    }



    public function canjoin($bool = true)
    {
        $this->query->where($this->table . '.canjoin', $bool);
        return $this;
    }

    public function excludeIds($ids = [])
    {
        $this->query->whereNotIn($this->table . '.id', $ids);
        return $this;
    }


    /**
     * @return IUserServiceQuery
     */
    public function byShareableToken($token)
    {

        $this->query->where($this->table . ".shareable_token", $token);
        return $this;
    }

    public function find()
    {
        return $this->query->first();
    }

    public function orderDesc()
    {
        $this->query->orderByDesc($this->table . '.created_at');
        return $this;
    }

    public function soonerThan($date, $column = null)
    {

        if ($column !== null) {
            $this->query->whereDate($column, "<=", $date);
        } else {
            $this->query->whereDate($this->table . ".created_at", "<=", $date);
        }

        return $this;
    }

    public function laterThan($date, $column = null)
    {
        if ($column !== null) {
            $this->query->whereDate($column, ">=", $date);
        } else {
            $this->query->whereDate($this->table . ".created_at", ">=", $date);
        }

        return $this;
    }



    public function byType($type = "user")
    {
        $this->query->where($this->table . '.type', $type);
        return $this;
    }

    public function byEmail($email)
    {
        $this->query->where($this->table . '.email', $email);
        return $this;
    }

    public function byIndicatorId($id)
    {
        $this->query->where($this->table . '.indicator_id', $id);
        return $this;
    }

    public function byCode($code)
    {
        $this->query->where($this->table . '.code', $code);
        return $this;
    }

    public function findAll()
    {
        return $this->query->get();
    }

    public function findById($id)
    {
        $user = $this->query->where($this->table . '.id', $id)->first();
        return $user;
    }
    public function findByCode($id)
    {
        $user = $this->query->where($this->table . '.code', $id)->first();
        return $user;
    }
    public function findByEmail($id)
    {
        $user = $this->query->where($this->table . '.email', $id)->first();
        return $user;
    }

    public function byCountryId($id)
    {
        $this->query->where($this->table . '.country_id', $id);
        return $this;
    }
    public function getShToken($user_id)
    {
        $user = (new UserServiceQueryImpl())->findById($user_id);
        if (empty($user->id)) {
            return null;
        }
        if (empty($user->shareable_token)) {
            $user->shareable_token = pinCode(4) . $user->id;
            (new UserServiceImpl())->update($user);
        }

        return $user->shareable_token;
    }
}
