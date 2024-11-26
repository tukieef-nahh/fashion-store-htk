<?php

namespace App\Aspects;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoggingInterceptor implements MethodInterceptor
{
    public function invoke(MethodInvocation $invocation)
    {    
        // Before method execution
        $methodName = $invocation->getMethod()->getName();
        $user = Auth::user();
        $username = $user ? $user->name : 'Guest';
        Log::info("User {$username} (ID: {$user->id}) called method {$methodName} with arguments: " . json_encode($invocation->getArguments()));
        // Proceed with the original method in the Service
        $result = $invocation->proceed();
        // After method execution
        Log::info("User {$username} (ID: {$user->id}) finished method {$methodName}, result: " . json_encode($result));
        return $result;
    }
}
