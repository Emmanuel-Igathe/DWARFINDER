$ErrorActionPreference = 'SilentlyContinue'

Write-Host "`n=== Testing Authentication Enforcement ===`n" -ForegroundColor Cyan

# Test 1: Dashboard
Write-Host "Test 1: Accessing /dashboard (should redirect to /login)" -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri 'http://localhost:8000/dashboard' -MaximumRedirection 0
    Write-Host "  Status: $($response.StatusCode) - NO REDIRECT (FAIL)" -ForegroundColor Red
} catch {
    if ($_.Exception.Response.StatusCode.value__ -eq 302) {
        $location = $_.Exception.Response.Headers.Location
        Write-Host "  Status: 302 Redirect" -ForegroundColor Green
        Write-Host "  Location: $location" -ForegroundColor Green
        if ($location -like "*login*") {
            Write-Host "  Result: PASS - Redirected to login" -ForegroundColor Green
        } else {
            Write-Host "  Result: FAIL - Not redirected to login" -ForegroundColor Red
        }
    } else {
        Write-Host "  Status: $($_.Exception.Response.StatusCode.value__) - UNEXPECTED" -ForegroundColor Red
    }
}

# Test 2: Discover
Write-Host "`nTest 2: Accessing /discover (should redirect to /login)" -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri 'http://localhost:8000/discover' -MaximumRedirection 0
    Write-Host "  Status: $($response.StatusCode) - NO REDIRECT (FAIL)" -ForegroundColor Red
} catch {
    if ($_.Exception.Response.StatusCode.value__ -eq 302) {
        $location = $_.Exception.Response.Headers.Location
        Write-Host "  Status: 302 Redirect" -ForegroundColor Green
        Write-Host "  Location: $location" -ForegroundColor Green
        if ($location -like "*login*") {
            Write-Host "  Result: PASS - Redirected to login" -ForegroundColor Green
        } else {
            Write-Host "  Result: FAIL - Not redirected to login" -ForegroundColor Red
        }
    } else {
        Write-Host "  Status: $($_.Exception.Response.StatusCode.value__) - UNEXPECTED" -ForegroundColor Red
    }
}

# Test 3: Matches
Write-Host "`nTest 3: Accessing /matches (should redirect to /login)" -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri 'http://localhost:8000/matches' -MaximumRedirection 0
    Write-Host "  Status: $($response.StatusCode) - NO REDIRECT (FAIL)" -ForegroundColor Red
} catch {
    if ($_.Exception.Response.StatusCode.value__ -eq 302) {
        $location = $_.Exception.Response.Headers.Location
        Write-Host "  Status: 302 Redirect" -ForegroundColor Green
        Write-Host "  Location: $location" -ForegroundColor Green
        if ($location -like "*login*") {
            Write-Host "  Result: PASS - Redirected to login" -ForegroundColor Green
        } else {
            Write-Host "  Result: FAIL - Not redirected to login" -ForegroundColor Red
        }
    } else {
        Write-Host "  Status: $($_.Exception.Response.StatusCode.value__) - UNEXPECTED" -ForegroundColor Red
    }
}

# Test 4: Welcome page (should be accessible)
Write-Host "`nTest 4: Accessing / (should be accessible)" -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri 'http://localhost:8000/' -MaximumRedirection 0
    if ($response.StatusCode -eq 200) {
        Write-Host "  Status: 200 OK" -ForegroundColor Green
        Write-Host "  Result: PASS - Welcome page accessible" -ForegroundColor Green
    } else {
        Write-Host "  Status: $($response.StatusCode) - UNEXPECTED" -ForegroundColor Red
    }
} catch {
    Write-Host "  Error: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "  Result: FAIL" -ForegroundColor Red
}

Write-Host "`n=== Test Summary ===`n" -ForegroundColor Cyan
