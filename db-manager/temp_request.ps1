try {
    $r = Invoke-WebRequest -Uri 'http://127.0.0.1:8000/businesses' -TimeoutSec 10 -UseBasicParsing
    Write-Output $r.StatusCode
} catch {
    Write-Output $_.Exception.Message
}
