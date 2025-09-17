<div class="container my-4">
    <h2>Connexion</h2>
    <form action="" method="post">
        <div>
            <label for="login" class="form-label">Login :</label>
            <input type="text" name="login" id="login" class="form-control" /><br/>

            <label for="mdp" class="form-label">Mot de passe :</label>
            <div class="input-group mb-3">
                <input type="password" name="mdp" id="mdp" class="form-control" required />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mdp', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <input type="submit" value="Envoyer" class="btn btn-primary"/>
        </div>
    </form>
</div>