
# CONTRIBUTING - STEP BY STEP

1. Fork this project on your github account
2. Clone the forked project on your local environment
3. So now, you can install dependencies and activate the hooks:

```bash
composer install
```

4. Activate all the hooks:

```bash
./vendor/bin/captainhook install -f -s
```

5. Copy the `phpunit.xml.dist` to `phpunit.xml` with your desired variables on bottom file.

6. Code & Enjoy it!

7. When you are done coding:

Run the code linter

```bash
composer lint
```

Then, run style, static analysis and integration tests:

```bash
composer tests
```

And finally, if you have set up a `ASAAS_SANDBOX_API_KEY`, run the tests again reaching the Asaas API:

```bash
composer test:asaas
```
