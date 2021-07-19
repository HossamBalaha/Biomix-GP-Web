<?php

namespace App;

// https://github.com/juliardi/C45
// https://php-ml.readthedocs.io/en/latest/machine-learning/classification/naive-bayes/

use Phpml\Classification\NaiveBayes;

class ML
{
    const NAIVE_BAYES = 1;

    private $X = [];
    private $accuracy = 0;
    private $approach = null;
    private $classifier = null;
    private $content = null;
    private $hasHeader = null;
    private $header = null;
    private $totalCount = 0;
    private $trainingFile = null;
    private $y = [];

    /**
     * ML constructor.
     * @param $trainingFile
     * @param int $approach
     * @param bool $hasHeader
     * @throws \Exception
     */
    public function __construct($trainingFile, $approach = ML::NAIVE_BAYES, $hasHeader = True)
    {
        $this->trainingFile = $trainingFile;
        $this->approach = $approach;
        $this->hasHeader = $hasHeader;

        $this->__collectXy();
    }

    /**
     * @throws \Exception
     */
    private function __collectXy()
    {
        $csv = $this->__parseCSV();
        $this->X = [];
        $this->y = [];
        if ($this->hasHeader) {
            $this->header = $csv[0];
            $this->content = array_slice($csv, 1);
        } else {
            $this->header = null;
            $this->content = array_slice($csv, 0);
        }
        foreach ($this->content as $row) {
            array_push($this->X, array_slice($row, 0, count($row) - 1));
            array_push($this->y, $row[count($row) - 1]);
        }
        $this->totalCount = count($this->y);
    }

    /**
     * @throws \Exception
     */
    private function __handleNaiveBayes()
    {
        $this->classifier = new NaiveBayes();
        $this->classifier->train($this->X, $this->y);
        $predictedY = $this->classifier->predict($this->X);
        $accuracy = 0;
        for ($i = 0; $i < $this->totalCount; $i++) {
            $accuracy += ($predictedY[$i] == $this->y[$i]);
        }
        $accuracy /= $this->totalCount;
        $this->accuracy = $accuracy * 100.0;
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function __parseCSV()
    {
        if (!file_exists($this->trainingFile))
            throw new \Exception("Something went wrong.");
        $csv = array_map('str_getcsv', file($this->trainingFile));
        return $csv;
    }

    /**
     * @return int
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    public function getSymptoms()
    {
        return $this->header ? array_slice($this->header, 0, count($this->header) - 1) : null;
    }

    /**
     * @return array
     */
    public function getX()
    {
        return $this->X;
    }

    /**
     * @return array
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param $record
     * @return mixed
     * @throws \Exception
     */
    public function predict($record)
    {
        if (!$this->classifier) {
            throw new \Exception("Something went wrong.");
        }

        if ($this->approach == ML::NAIVE_BAYES) {
            return $this->classifier->predict($record);
        } else {
            throw new \Exception("Something went wrong.");
        }
    }

    /**
     * @throws \Exception
     */
    public function train()
    {
        if ($this->approach == ML::NAIVE_BAYES) {
            $this->__handleNaiveBayes();
        } else {
            throw new \Exception("Something went wrong.");
        }
    }
}


//    private function __handleDecisionTree($force = False)
//    {
//        // https://github.com/juliardi/C45
//        $treeFile = storage_path("machine-learning/tree.bin");
//        if (!$force && file_exists($treeFile)) {
//            $treeUnSerialized = file_get_contents($treeFile);
//            $tree = unserialize($treeUnSerialized);
//        } else {
//            $c45 = new C45([
//                'targetAttribute' => 'Disease',
//                'trainingFile' => storage_path("machine-learning/data2.csv"),
//                'splitCriterion' => C45::SPLIT_GAIN_RATIO,
//            ]);
//            $tree = $c45->buildTree();
//            $treeSerialized = serialize($tree);
//
//            $fp = fopen($treeFile, "wb");
//            fwrite($fp, $treeSerialized);
//            fclose($fp);
//        }
//        $treeString = $tree->toString();
//        return $tree;
//    }
//
//    private function __handleNaiveBayes($force = False)
//    {
//        if (!$force && file_exists($treeFile)) {
//            $treeUnSerialized = file_get_contents($treeFile);
//            $tree = unserialize($treeUnSerialized);
//        } else {
//            $c45 = new C45([
//                'targetAttribute' => 'Disease',
//                'trainingFile' => storage_path("machine-learning/data2.csv"),
//                'splitCriterion' => C45::SPLIT_GAIN_RATIO,
//            ]);
//            $tree = $c45->buildTree();
//            $treeSerialized = serialize($tree);
//
//            $fp = fopen($treeFile, "wb");
//            fwrite($fp, $treeSerialized);
//            fclose($fp);
//        }
//        $treeString = $tree->toString();
//        return $tree;
//    }
