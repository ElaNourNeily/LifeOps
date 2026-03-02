# Testing Guide for LifeOps

This project uses **PHPUnit** for unit testing and **PHPStan** for static analysis.

## 1. Running Tests

To run the entire test suite, execute the following command in your terminal:

```bash
vendor/bin/phpunit
```

To run a specific test file:
```bash
vendor/bin/phpunit tests/Service/AIPlannerServiceTest.php
```

## 2. Static Analysis (PHPStan)

To verify the code quality and type safety (Level 6):

```bash
vendor/bin/phpstan analyse src/Service src/Repository
```

## 3. Database Audit (Doctrine Doctor)

The database audit is integrated into the **Symfony Web Profiler**. 
1. Open your application in a browser.
2. Look for the "stethoscope" icon (🩺) in the bottom toolbar.
3. Click it to see performance and security analysis for the current page.

## 4. How to Create a New Test

Tests are located in the `tests/` directory.

### Boilerplate Example
If you create a new service `CalculationService`, create a test at `tests/Service/CalculationServiceTest.php`:

```php
<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\CalculationService;

class CalculationServiceTest extends TestCase
{
    public function testAddNumbers(): void
    {
        $service = new CalculationService();
        $result = $service->add(2, 3);
        
        $this->assertEquals(5, $result);
    }
}
```

## 5. Current Test Coverage
- `AIPlannerService`: Prompt logic, parsing, and suggestion saving.
- `StatisticsService`: Completion rates, priority distribution, and weekly stats.
- `Activite Entity`: Status logic and time validation.
