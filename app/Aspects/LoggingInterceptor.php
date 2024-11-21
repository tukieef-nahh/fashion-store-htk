<?php

namespace App\Aspects;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Illuminate\Support\Facades\Log;

class LoggingInterceptor implements MethodInterceptor
{
    public function invoke(MethodInvocation $invocation)
    {    
        // Before method execution
        $methodName = $invocation->getMethod()->getName();
        Log::info("Method {$methodName} called with arguments: " . json_encode($invocation->getArguments()));
        // Proceed with the original method in the Service
        $result = $invocation->proceed();
        // After method execution
        Log::info("Method {$methodName} returned: " . json_encode($result));
        return $result;
    }
}
