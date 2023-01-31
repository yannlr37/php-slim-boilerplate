<?php


use Phinx\Seed\AbstractSeed;

class FilmSeeder extends AbstractSeed
{
    const TABLE = 'films';

    public function run(): void
    {
        $items = [
            [
                'name' => 'Independance Day',
                'year' => 1996
            ],
            [
                'name' => 'Steve Jobs',
                'year' => 2015
            ],
            [
                'name' => 'Goonies',
                'year' => 1985
            ]
        ];

        foreach ($items as $item) {
            $table = $this->table(self::TABLE);
            $table->insert($item)->saveData();
        }
    }
}
