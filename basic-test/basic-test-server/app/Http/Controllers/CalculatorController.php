<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function upload(CalculatorRequest $request)
    {
        $file = $request->file('file')->store('/public/instructions');

        return $this->calculate($file);
    }

    public function calculate($file, $mode = "local")
    {
        if (Storage::exists($file)) {
        	if ($mode == "test") {
        		$fileURL = env('APP_URL').'/'.str_replace("public", "storage", $file);
        	} else {
        		$fileURL = getcwd().'/'.str_replace("public", "storage", $file);
        	}
        	
            $lines = file($fileURL, FILE_SKIP_EMPTY_LINES);
            $total = count($lines);
            $lastLineNumber = $total - 1;

            if ($total) {        
            	$hasApply = strpos($lines[$lastLineNumber], 'apply ');

            	if ($hasApply === false) {
		            return false;
				} else {
					$initialNumber = str_replace("apply ", "", $lines[$lastLineNumber]);

					$answer = $initialNumber;

					foreach ($lines as $line_num => $line) {
	            		$instructionAndNumberArray = explode(" ", $line);//add 3
	            		$instruction = $instructionAndNumberArray[0];//add
	            		$number = (Float) $instructionAndNumberArray[1];//3
	            			
		            	if ($line_num == 0 && $line_num <> $lastLineNumber) {
		            		switch ($instruction) {
		            			case 'add':
		            				$answer = ($initialNumber + $number);
		            				break;
		            			case 'multiply':
		            				$answer = ($initialNumber * $number);
		            				break;
		            			case 'subtract':
		            				$answer = ($initialNumber - $number);
		            				break;
		            			case 'divide':
		            				$answer = ($initialNumber / $number);
		            				break;
		            			default:
		            				$answer;
		            		}
		            	} else if ($line_num <> $lastLineNumber) {
		            		switch ($instruction) {
		            			case 'add':
		            				$answer = $answer + $number;
		            				break;
		            			case 'multiply':
		            				$answer = $answer * $number;
		            				break;
		            			case 'subtract':
		            				$answer = $answer - $number;
		            				break;
		            			case 'divide':
		            				$answer = $answer / $number;
		            				break;
		            			default:
		            				$answer;
		            		}
		            	}
		            }

		            return $answer;
				}
            }
        }
    }
}
